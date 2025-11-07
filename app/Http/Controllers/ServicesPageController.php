<?php

namespace App\Http\Controllers;

use App\Models\HeaderLayanan;
use App\Models\HeaderFiturUtama;
use App\Models\HeaderDaftarLayanan;
use App\Models\FiturUtama;
use App\Models\DaftarLayanan;
use Illuminate\Http\Request;

class ServicesPageController extends Controller
{
    public function index()
    {
        $headerLayanan = HeaderLayanan::where('status_aktif', true)->first();
        $headerFiturUtama = HeaderFiturUtama::where('status_aktif', true)->first();
        $headerDaftarLayanan = HeaderDaftarLayanan::where('status_aktif', true)->first();
        $fiturUtamas = FiturUtama::where('status_aktif', true)->orderBy('created_at', 'desc')->get();
        $daftarLayanans = DaftarLayanan::where('status_aktif', true)->orderBy('created_at', 'desc')->get();
        
        return view('frontend.services', compact('headerLayanan', 'headerFiturUtama', 'headerDaftarLayanan', 'fiturUtamas', 'daftarLayanans'));
    }
}
