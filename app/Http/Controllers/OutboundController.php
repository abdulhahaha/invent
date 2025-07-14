<?php

namespace App\Http\Controllers;

use App\Models\Outbound;
use Illuminate\Http\Request;

class OutboundController extends Controller
{
    public function index()
    {
        $outbounds = Outbound::all();
        return view('pages.outbound.index', compact('outbounds'));
    }

    public function create()
    {
        return view('pages.outbound.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipped_date' => 'required|date',
            'no_document' => 'required|string|max:255',
            'material' => 'required|string|max:100',
            'material_description' => 'required|string|max:255',
            'inbound_qty' => 'required|numeric|min:1',
            'uom' => 'required|string|max:10',
        ]);

        Outbound::create($validated);

        return redirect()->route('outbound.index')->with('success', 'Data barang keluar berhasil ditambahkan.');
    }


    public function edit(Outbound $outbound)
    {
        return view('invent.outbound.edit', compact('outbound'));
    }

    public function update(Request $request, Outbound $outbound)
    {
        $request->validate([
            'shipped_date' => 'required|date',
            'no_document' => 'required',
            'shipper' => 'required',
            'plt_id' => 'required',
            'location' => 'required',
            'material' => 'required',
            'material_description' => 'required',
            'inbound_qty' => 'required|integer',
            'uom' => 'required',
        ]);

        $outbound->update($request->all());

        return redirect()->route('invent.outbound.index')->with('success', 'Outbound updated successfully.');
    }

    public function destroy(Outbound $outbound)
    {
        $outbound->delete();

        return redirect()->route('invent.outbound.index')->with('success', 'Outbound deleted successfully.');
    }

    public function laporan()
    {
        $outbounds = Outbound::all();
        return view('pages.outbound.laporan', compact('outbounds'));
    }
}
