<?php

namespace App\Http\Controllers;

use App\Models\TbArsip;
use App\Models\TbKategoriArsip;
use App\Models\TbKodeKlasifikasi;
use App\Models\TbLampiran;
use App\Models\TbRak;
use App\Models\TbUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function download($id)
    {
        $lampiran = TbLampiran::findOrFail($id);

        if (!$lampiran->url_file || !Storage::disk('public')->exists($lampiran->url_file)) {
            return redirect()->back()->with('error', 'File lampiran tidak ditemukan.');
        }
        $filePath = storage_path('app/public/' . $lampiran->url_file);
        return response()->download($filePath);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arsips = TbArsip::all();
        return view('arsip.index', compact('arsips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_arsips = TbKategoriArsip::all();
        $kode_klasifikasis = TbKodeKlasifikasi::all();
        $users = TbUser::all();
        $raks = TbRak::all();
        return view('arsip.create', compact('kategori_arsips', 'kode_klasifikasis', 'raks', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_arsip' => 'required|string|max:255|unique:tb_arsip,nomor_arsip',
            'perihal' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'id_kategori' => 'required|exists:tb_kategori_arsip,id_kategori',
            'id_kode_klasifikasi' => 'required|exists:tb_kode_klasifikasi,id_kode_klasifikasi',
            'jenis_arsip' => 'required|in:segera,rahasia,penting,biasa',
            'kategori_sifat' => 'required|in:masuk,keluar',
            'pengirim' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
            'id_rak' => 'required|exists:tb_rak,id_rak',
            'id_user_pemilik' => 'required|exists:tb_user,id_user',
            'lampiran' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ], [
            'nomor_arsip.required' => 'Nomor arsip harus diisi.',
            'nomor_arsip.unique' => 'Nomor arsip sudah terdaftar.',
            'id_kategori.exists' => 'Kategori bidang arsip tidak valid.',
            'id_kode_klasifikasi.exists' => 'Kode klasifikasi tidak valid.',
            'id_rak.exists' => 'Rak tidak valid.',
            'id_user_pemilik.exists' => 'User tidak valid.',
            'jenis_arsip.in' => 'Jenis arsip tidak valid.',
            'kategori_sifat.in' => 'Kategori sifat tidak valid.',
        ]);

        $arsip = TbArsip::create([
            'nomor_arsip' => $validatedData['nomor_arsip'],
            'perihal' => $validatedData['perihal'],
            'tanggal_surat' => $validatedData['tanggal_surat'],
            'id_kategori' => $validatedData['id_kategori'],
            'id_kode_klasifikasi' => $validatedData['id_kode_klasifikasi'],
            'jenis_arsip' => $validatedData['jenis_arsip'],
            'kategori_sifat' => $validatedData['kategori_sifat'],
            'pengirim' => $validatedData['pengirim'],
            'penerima' => $validatedData['penerima'],
            'id_rak' => $validatedData['id_rak'],
            'id_user_pemilik' => $validatedData['id_user_pemilik'],
        ]);

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filePath = $file->store('lampiran', 'public');

            TbLampiran::create([
                'id_arsip' => $arsip->id_arsip,
                'url_file' => $filePath,
                'nama_file' => $file->getClientOriginalName(),
            ]);
        }

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(TbArsip $arsip)
    {
        $arsip->load(['tb_kategori_arsip', 'tb_kode_klasifikasi', 'tb_user', 'tb_lampiran']);

        return view('arsip.detail', compact('arsip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TbArsip $arsip)
    {
        $kategori_arsips = TbKategoriArsip::all();
        $kode_klasifikasis = TbKodeKlasifikasi::all();
        $users = TbUser::all();
        $raks = TbRak::all();
        return view('arsip.edit', compact('arsip', 'kategori_arsips', 'kode_klasifikasis', 'raks', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TbArsip $arsip)
    {
        $request->validate([
            'nomor_arsip' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'id_kategori' => 'required|exists:tb_kategori_arsip,id_kategori',
            'id_kode_klasifikasi' => 'required|exists:tb_kode_klasifikasi,id_kode_klasifikasi',
            'jenis_arsip' => 'required|string',
            'kategori_sifat' => 'required|string',
            'pengirim' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
            'id_rak' => 'required|exists:tb_rak,id_rak',
            'id_user_pemilik' => 'required|exists:tb_user,id_user',
            'lampiran' => 'nullable|file|max:2048',
            'status_arsip' => 'required|in:aktif,inaktif,dipindahkan',
        ]);

        $arsip->fill($request->except('lampiran'));
        $arsip->save();

        if ($request->hasFile('lampiran')) {
            $lampiran = $arsip->tb_lampiran()->first();

            if ($lampiran) {
                Storage::disk('public')->delete($lampiran->url_file);

                $file = $request->file('lampiran');
                $filePath = $file->store('lampiran', 'public');

                $lampiran->update([
                    'nama_file' => $file->getClientOriginalName(),
                    'url_file' => $filePath,
                ]);
            } else {
                $file = $request->file('lampiran');
                $filePath = $file->store('lampiran', 'public');

                $arsip->tb_lampiran()->create([
                    'id_arsip' => $arsip->id_arsip,
                    'nama_file' => $file->getClientOriginalName(),
                    'url_file' => $filePath,
                ]);
            }
        }


        return redirect()->route('arsip.index')->with('success', 'Data arsip berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TbArsip $arsip)
    {
        $arsip->delete();

        return redirect()->route('arsip.index')->with('success', 'Data Rak berhasil dihapus.');
    }
}
