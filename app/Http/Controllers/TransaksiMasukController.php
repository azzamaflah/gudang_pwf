<?php

namespace App\Http\Controllers;

use App\Models\TransaksiMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;

class TransaksiMasukController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiMasuk::with('barang')->latest()->get();
        return view('transaksi_masuk.index', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('transaksi_masuk.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        // Simpan transaksi
        TransaksiMasuk::create($request->all());

        // Update stok barang
        $barang = Barang::findOrFail($request->barang_id);
        $barang->stok += $request->jumlah;
        $barang->save();

        return redirect()->route('transaksi-masuk.index')->with('success', 'Barang masuk berhasil dicatat.');
    }
}
