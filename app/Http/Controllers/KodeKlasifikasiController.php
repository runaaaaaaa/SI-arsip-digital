<?php

namespace App\Http\Controllers;

use App\Models\TbKodeKlasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KodeKlasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data dan urutkan sesuai kode klasifikasi
        $kodeKlasifikasis = TbKodeKlasifikasi::orderBy('kode_klasifikasi')->get();

        // Konversi ke format hierarki
        $tree = $this->buildTree($kodeKlasifikasis);

        return view('kode_klasifikasi.index', compact('tree'));
    }

    /**
     * Fungsi rekursif untuk membangun struktur hierarki
     */
    private function buildTree($elements, $parentId = null)
    {
        $branch = [];

        foreach ($elements as $element) {
            if ($element->id_parent_klasifikasi == $parentId) {
                $children = $this->buildTree($elements, $element->id_kode_klasifikasi);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentKlasifikasi = TbKodeKlasifikasi::all();
        return view('kode_klasifikasi.create', compact('parentKlasifikasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'kode_klasifikasi' => 'required|string|max:255|unique:tb_kode_klasifikasi,kode_klasifikasi',
                'nama_klasifikasi' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:255',
                'id_parent_klasifikasi' => 'nullable|exists:tb_kode_klasifikasi,id_kode_klasifikasi',
            ],
            [
                'kode_klasifikasi.required' => 'Kode Klasifikasi harus diisi.',
                'kode_klasifikasi.unique' => 'Kode Klasifikasi sudah sudah ada.',
                'nama_klasifikasi.required' => 'Nama Klasifikasi harus diisi.',
                'deskripsi.required' => 'Deskripsi harus diisi.',
            ]
        );

        TbKodeKlasifikasi::create([
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'nama_klasifikasi' => $request->nama_klasifikasi,
            'deskripsi' => $request->deskripsi,
            'id_parent_klasifikasi' => $request->id_parent_klasifikasi,
        ]);

        return redirect()->route('kode_klasifikasi.index')->with('success', 'Data Kode Klasifikasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TbKodeKlasifikasi $kode_klasifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TbKodeKlasifikasi $kode_klasifikasi)
    {
        $parentKlasifikasi = TbKodeKlasifikasi::all();
        return view('kode_klasifikasi.edit', compact('kode_klasifikasi', 'parentKlasifikasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TbKodeKlasifikasi $kode_klasifikasi)
    {
        $validatedData = $request->validate([
            'kode_klasifikasi' => 'required|string|max:255||unique:tb_kode_klasifikasi,kode_klasifikasi,' . $kode_klasifikasi->id_kode_klasifikasi . ',id_kode_klasifikasi',
            'nama_klasifikasi' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'id_parent_klasifikasi' => 'nullable|exists:tb_kode_klasifikasi,id_kode_klasifikasi',
        ]);

        $kode_klasifikasi->update($validatedData);

        return redirect()->route('kode_klasifikasi.index')->with('success', 'Data Kode Klasifikasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TbKodeKlasifikasi $kode_klasifikasi)
    {
        $kode_klasifikasi->delete();

        return redirect()->route('kode_klasifikasi.index')->with('success', 'Data Kode Klasifikasi berhasil dihapus.');
    }
}
