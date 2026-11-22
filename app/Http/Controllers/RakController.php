<?php

namespace App\Http\Controllers;

use App\Models\TbRak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raks = TbRak::all();
        return view('rak.index', compact('raks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama_rak' => 'required|string|max:255',
                'lokasi_rak' => 'required|string|max:255',
            ],
            [
                'nama_rak.required' => 'Nama Rak harus diisi.',
                'lokasi_rak.required' => 'Lokasi Rak harus diisi.',
            ]
        );

        TbRak::create($validatedData);

        return redirect()->route('rak.index')->with('success', 'Data Rak berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TbRak $rak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TbRak $rak)
    {
        return view('rak.edit', compact('rak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TbRak $rak)
    {
        $validatedData = $request->validate([
            'nama_rak' => 'required|string|max:255',
            'lokasi_rak' => 'required|string|max:255',
        ]);

        $rak->update($validatedData);

        return redirect()->route('rak.index')->with('success', 'Data Rak berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TbRak $rak)
    {
        $rak->delete();

        return redirect()->route('rak.index')->with('success', 'Data Rak berhasil dihapus.');
    }
}
