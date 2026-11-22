<?php

namespace App\Http\Controllers;

use App\Models\TbKategoriArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KategoriArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori_arsips = TbKategoriArsip::all();
        return view('kategori_arsip.index', compact('kategori_arsips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori_arsip.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama_kategori' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:255',
            ],
            [
                'nama_kategori.required' => 'Nama Kategori harus diisi.',
                'deskripsi.required' => 'Deskripsi harus diisi.',
            ]
        );

        TbKategoriArsip::create($validatedData);

        return redirect()->route('kategori_arsip.index')->with('success', 'Data Kategori Arsip berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TbKategoriArsip $kategori_arsip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TbKategoriArsip $kategori_arsip)
    {
        return view('kategori_arsip.edit', compact('kategori_arsip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TbKategoriArsip $kategori_arsip)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);

        $kategori_arsip->update($validatedData);

        return redirect()->route('kategori_arsip.index')->with('success', 'Data Kategori Arsip berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TbKategoriArsip $kategori_arsip)
    {
        $kategori_arsip->delete();

        return redirect()->route('kategori_arsip.index')->with('success', 'Data Kategori Arsip berhasil dihapus.');
    }
}
