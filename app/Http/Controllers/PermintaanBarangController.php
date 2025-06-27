<?php

namespace App\Http\Controllers;

use App\Models\PermintaanBarang;
use App\Models\Barang;
use App\Models\TransaksiKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PermintaanBarangController extends Controller
{
    // Menampilkan daftar permintaan milik user
    public function index()
    {
        $permintaans = PermintaanBarang::with('barang')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('permintaan_barang.index', compact('permintaans'));
    }

    // Form permintaan baru
    public function create()
    {
        $barangs = Barang::all();
        return view('permintaan_barang.create', compact('barangs'));
    }

    // Simpan permintaan
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        PermintaanBarang::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'status' => 'pending',
        ]);

        return redirect()->route('permintaan-barang.index')
            ->with('success', 'Permintaan berhasil dikirim.');
    }

    // Admin: Menampilkan semua permintaan
    public function adminIndex()
    {
        $permintaans = PermintaanBarang::with(['user', 'barang'])->latest()->get();
        return view('admin.permintaan_barang.index', compact('permintaans'));
    }

    // Admin: Menyetujui permintaan
    public function approve($id)
    {
        $permintaan = PermintaanBarang::findOrFail($id);
        $permintaan->status = 'disetujui';
        $permintaan->save();

        // Jika ingin otomatis buat transaksi keluar
        \App\Models\TransaksiKeluar::create([
            'barang_id' => $permintaan->barang_id,
            'jumlah' => $permintaan->jumlah,
            'tanggal_keluar' => now(),
        ]);

        return redirect()->route('admin.permintaan-barang.index')->with('success', 'Permintaan disetujui.');
    }


    // Admin: Menolak permintaan
    public function reject($id)
    {
        $permintaan = PermintaanBarang::findOrFail($id);

        if ($permintaan->status !== 'pending') {
            return redirect()->back()->with('error', 'Permintaan sudah diproses sebelumnya.');
        }

        $permintaan->status = 'ditolak';
        $permintaan->save();

        return redirect()->back()->with('success', 'Permintaan ditolak.');
    }
}
