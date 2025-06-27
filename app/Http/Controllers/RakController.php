<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index()
    {
        $raks = Rak::all();
        return view('rak.index', compact('raks'));
    }

    public function create()
    {
        return view('rak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_rak' => 'required|string|max:255|unique:raks,kode_rak',
            'lokasi'   => 'required|string|max:255',
        ]);

        Rak::create([
            'kode_rak' => $request->kode_rak,
            'lokasi'   => $request->lokasi,
        ]);

        return redirect()->route('rak.index')->with('success', 'Rak berhasil ditambahkan.');
    }

    public function show(Rak $rak)
    {
        return view('rak.show', compact('rak'));
    }

    public function edit(Rak $rak)
    {
        return view('rak.edit', compact('rak'));
    }

    public function update(Request $request, Rak $rak)
    {
        $request->validate([
            'kode_rak' => 'required|string|max:255|unique:raks,kode_rak,' . $rak->id,
            'lokasi'   => 'required|string|max:255',
        ]);

        $rak->update([
            'kode_rak' => $request->kode_rak,
            'lokasi'   => $request->lokasi,
        ]);

        return redirect()->route('rak.index')->with('success', 'Rak berhasil diperbarui.');
    }

    public function destroy(Rak $rak)
    {
        $rak->delete();
        return redirect()->route('rak.index')->with('success', 'Rak berhasil dihapus.');
    }
}
