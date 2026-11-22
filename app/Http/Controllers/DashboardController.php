<?php

namespace App\Http\Controllers;

use App\Models\TbArsip;
use App\Models\TbKategoriArsip;
use App\Models\TbUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $currentYear = date('Y');
        $years = range($currentYear - 4, $currentYear);
        $countArsipByYear = [];
        foreach ($years as $year) {
            $countArsipByYear[$year] = TbArsip::whereYear('tanggal_surat', $year)->count();
        }
        $countKategori = TbKategoriArsip::count();
        return view('dashboard', compact('countArsipByYear', 'countKategori'));
    }
}
