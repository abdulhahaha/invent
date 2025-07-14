<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inbound;
use App\Models\Laporan;

class InboundController extends Controller
{
    // Menampilkan daftar semua data inbound
    public function index()
    {
        // $inbounds = Inbound::all();
        $inbounds = Inbound::orderBy('receive_date', 'desc')->get();
        return view('pages.inbound.index', compact('inbounds'));
    }

    // Menampilkan form untuk menambahkan inbound
    public function create()
    {
        return view('pages.inbound.add');
    }

    // Menyimpan data inbound baru
    public function store(Request $request)
    {
        $request->validate([
            'receive_date' => 'required|date',
            'no_document' => 'required|string',
            'consignee' => 'required|string',
            'material' => 'required|string',
            'material_description' => 'required|string',
            'inbound_qty' => 'required|numeric',
            'uom' => 'required|string',
            'plt_id' => 'required|string',
            'location' => 'required|string',
        ]);

        Inbound::create($request->all());

        return redirect()->route('inbound.index')->with('success', 'Data inbound berhasil ditambahkan.');
    }

    // Menampilkan form edit untuk data tertentu
    public function edit($id)
    {
        $inbound = Inbound::findOrFail($id);
        return view('pages.inbound.edit', compact('inbound'));
    }

    // Memperbarui data inbound
    public function update(Request $request, $id)
    {
        $request->validate([
            'receive_date' => 'required|date',
            'no_document' => 'required|string',
            'consignee' => 'required|string',
            'material' => 'required|string',
            'material_description' => 'required|string',
            'inbound_qty' => 'required|numeric',
            'uom' => 'required|string',
            'plt_id' => 'required|string',
            'location' => 'required|string',
        ]);

        $inbound = Inbound::findOrFail($id);
        $inbound->update($request->all());

        return redirect()->route('pages.inbound.index')->with('success', 'Data inbound berhasil diperbarui.');
    }

    // Menghapus data inbound
    public function destroy($id)
    {
        $inbound = Inbound::findOrFail($id);
        $inbound->delete();

        return redirect()->route('pages.inbound.index')->with('success', 'Data inbound berhasil dihapus.');
    }

    public function laporan()
    {   
        // $laporan = Laporan::all();
        $inbounds = Inbound::all();
        return view('pages.inbound.laporan', compact('inbounds'));
    }

}

