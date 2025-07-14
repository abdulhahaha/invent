<?php

namespace App\Http\Controllers;

use App\Models\Inbound;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;


class InventoryController extends Controller
{
    /**
     * Menampilkan daftar seluruh inventory (gabungan data inbound & inventory).
     */
    public function index()
    {
        $inbound = Inbound::orderBy('receive_date', 'desc')->get()->map(function ($item) {
            $item->id_with_source = $item->id . '_inbound';
            $item->source = 'inbound';
            return $item;
        });

        $invent = Inventory::orderBy('receive_date', 'desc')->get()->map(function ($item) {
            $item->id_with_source = $item->id . '_inventory';
            $item->source = 'inventory';
            return $item;
        });

        $inventory = $inbound->concat($invent)->sortByDesc('receive_date')->values();

        return view('pages.invent.index', compact('inventory'));
    }

    /**
     * Menampilkan form untuk menambah data inventory.
     */
    public function create(Request $request)
    {
        $inbound = null;

        // Ambil data inbound berdasarkan ID jika tersedia di query string
        if ($request->has('id')) {
            $inbound = Inbound::find($request->id);
        }

        $inventory = Inventory::orderBy('receive_date', 'desc')->get();

        return view('pages.invent.add', compact('inventory', 'inbound'));
    }

    /**
     * Menyimpan data inventory baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receive_date'           => 'required|date',
            'location'               => 'required|string|max:100',
            'plt_id'                 => 'required|string|max:100',
            'material'               => 'required|string|max:100',
            'material_description'   => 'required|string|max:255',
            'uom'                    => 'required|string|max:10',
            'unrestricted'           => 'required|numeric|min:0',
            'blocked'                => 'required|numeric|min:0',
            'remarks'                => 'nullable|string|max:255',
        ]);

        Inventory::create($validated);

        return redirect()->route('invent.index')
            ->with('success', 'Data inventaris berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk inventory tertentu.
     */
    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);

        return view('pages.invent.edit', compact('inventory'));
    }

    /**
     * Memperbarui data inventory berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'unrestricted' => 'required|numeric|min:0',
            'blocked'      => 'required|numeric|min:0',
            'remarks'      => 'nullable|string|max:255',
        ]);

        $inventory = Inventory::findOrFail($id);

        $inventory->update($validated);

        return redirect()->route('invent.index')
            ->with('success', 'Data inventory berhasil diperbarui.');
    }


    public function ringkasanPenyimpanan()
    {
        $rekap = DB::table('inventories')
            ->select('location',
                DB::raw('SUM(unrestricted) as total_unrestricted'),
                DB::raw('SUM(blocked) as total_blocked')
            )
            ->groupBy('location')
            ->get();

        return view('pages.invent.ringkasan', compact('rekap'));
    }

    public function updateRingkasan(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|exists:inventories,location',
            'unrestricted_delta' => 'required|integer',
            'blocked_delta' => 'required|integer',
        ]);

        // Jalankan transaksi agar update konsisten
        DB::transaction(function () use ($validated) {
            DB::table('inventories')
                ->where('location', $validated['location'])
                ->update([
                    'unrestricted' => DB::raw("unrestricted + ({$validated['unrestricted_delta']})"),
                    'blocked' => DB::raw("blocked + ({$validated['blocked_delta']})"),
                    'updated_at' => now()
                ]);
        });

        return back()->with('success', 'Stok berhasil diperbarui.');
    }

    public function transferStok(Request $request)
    {
        $validated = $request->validate([
            'from_location' => 'required|string|different:to_location|exists:inventories,location',
            'to_location' => 'required|string|exists:inventories,location',
            'amount' => 'required|integer|min:1',
        ]);

        // Ambil stok dari lokasi asal
        $currentStock = DB::table('inventories')
            ->where('location', $validated['from_location'])
            ->value('unrestricted');

        if ($currentStock < $validated['amount']) {
            return back()->withErrors(['amount' => 'Jumlah stok tidak mencukupi di lokasi asal.']);
        }

        // Lakukan transaksi pemindahan
        DB::transaction(function () use ($validated) {
            DB::table('inventories')
                ->where('location', $validated['from_location'])
                ->update([
                    'unrestricted' => DB::raw("unrestricted - ({$validated['amount']})"),
                    'updated_at' => now()
                ]);

            DB::table('inventories')
                ->where('location', $validated['to_location'])
                ->update([
                    'unrestricted' => DB::raw("unrestricted + ({$validated['amount']})"),
                    'updated_at' => now()
                ]);
        });

        return back()->with('success', 'Stok berhasil dipindahkan.');
    }


    // Hapus data
    public function destroy($id)
    {

         [$id, $source] = explode('_', $id);
        // Ambil model berdasarkan sumber
        if ($source === 'inventory') {
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();
        } elseif ($source === 'inbound') {
            $inventory = Inbound::findOrFail($id);
            $inventory->delete();
        } else {
            return redirect()->back()->with('error', 'Sumber data tidak valid.');
        }

        if (!$inventory) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        

        return redirect()->route('invent.index')->with('success', 'Data inventaris berhasil dihapus.');
    }

    public function laporan()
    {
        $inventory = Inventory::all();
        return view('pages.invent.laporan', compact('inventory'));
    }
}
