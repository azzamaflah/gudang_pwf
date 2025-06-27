<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with(['kategori', 'rak'])->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $raks = Rak::all();
        return view('barang.create', compact('kategoris', 'raks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'rak_id' => 'required|exists:raks,id',
            'stok' => 'required|integer|min:0',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'rak_id' => $request->rak_id,
            'stok' => $request->stok,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        $raks = Rak::all();
        return view('barang.edit', compact('barang', 'kategoris', 'raks'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'rak_id' => 'required|exists:raks,id',
            'stok' => 'required|integer|min:0',
        ]);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'rak_id' => $request->rak_id,
            'stok' => $request->stok,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }

    public function exportPdf()
    {
        $barangs = Barang::with(['kategori', 'rak'])->get();
        $pdf = Pdf::loadView('barang.pdf', compact('barangs'));
        return $pdf->download('data-barang.pdf');
    }
}
