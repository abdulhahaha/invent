<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    // Menampilkan semua laporan untuk diverifikasi
    public function index()
    {
        $laporan = Laporan::with('admin')->get(); // pastikan relasi 'admin' ada di model Laporan
        return view('pages.supervisor.index', compact('laporan'));
    }

    public function verifikasi($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'terverifikasi';
        $laporan->save();

        return redirect()->route('supervisor.index')->with('success', 'Laporan berhasil diverifikasi.');
    }

    // Menampilkan halaman rekapitulasi laporan
    public function rekap()
    {
        $laporan = Laporan::with('admin')->orderBy('tanggal', 'desc')->get();
        return view('pages.supervisor.rekap', compact('laporan'));
    }
}
