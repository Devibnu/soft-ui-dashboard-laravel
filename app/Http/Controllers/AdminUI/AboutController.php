<?php

namespace App\Http\Controllers\AdminUI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display the about form for admin
     */
    public function index()
    {
        // Ambil data pertama dari tabel atau buat instance kosong
        $about = About::first() ?? new About();
        
        return view('adminui.about.index', compact('about'));
    }

    /**
     * Store or update about data
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'isi_konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'custom_link' => 'nullable|url',
            'is_active' => 'required|boolean',
        ]);

        // Ambil data yang ada atau buat array baru
        $about = About::first();
        $data = $validated;

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($about && $about->gambar && file_exists(public_path($about->gambar))) {
                unlink(public_path($about->gambar));
            }
            
            $gambar = $request->file('gambar');
            $filename = time() . '_gambar.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads/about'), $filename);
            $data['gambar'] = 'uploads/about/' . $filename;
        }

        // Handle header image upload
        if ($request->hasFile('header_image')) {
            // Hapus header image lama jika ada
            if ($about && $about->header_image && file_exists(public_path($about->header_image))) {
                unlink(public_path($about->header_image));
            }
            
            $headerImage = $request->file('header_image');
            $filename = time() . '_header.' . $headerImage->getClientOriginalExtension();
            $headerImage->move(public_path('uploads/about'), $filename);
            $data['header_image'] = 'uploads/about/' . $filename;
        }

        // Gunakan updateOrCreate untuk memastikan hanya 1 data
        About::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'Data About berhasil disimpan!');
    }
}