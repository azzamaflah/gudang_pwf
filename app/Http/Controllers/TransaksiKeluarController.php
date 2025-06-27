<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKeluar;
use App\Models\Barang;
use Illuminate\Http\Request;

class TransaksiKeluarController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiKeluar::with('barang')->latest()->get();
        return view('transaksi_keluar.index', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('transaksi_keluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi'])->withInput();
        }

        $barang->stok -= $request->jumlah;
        $barang->save();

        TransaksiKeluar::create($request->all());

        return redirect()->route('transaksi-keluar.index')->with('success', 'Transaksi keluar berhasil disimpan.');
    }
}
