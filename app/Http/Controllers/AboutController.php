<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutPage;
use App\Models\AboutHeader;
use App\Models\AboutContent;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutPage::first();
        return view('adminui.about.index', compact('about'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_singkat' => 'nullable|string|max:255',
            'isi_konten' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'judul.required' => 'Judul harus diisi.',
            'judul.max' => 'Judul terlalu panjang (maksimal 255 karakter).',
            'deskripsi_singkat.max' => 'Deskripsi singkat terlalu panjang (maksimal 255 karakter).',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar tidak didukung. Gunakan JPEG, PNG, JPG, GIF, atau WEBP.',
            'gambar.max' => 'Ukuran gambar terlalu besar. Maksimal 5MB (5120 KB).',
        ]);

        try {
            $about = AboutPage::first() ?? new AboutPage();

            if ($request->hasFile('gambar')) {
                // Delete old image if exists
                if ($about->gambar && \Storage::disk('public')->exists($about->gambar)) {
                    \Storage::disk('public')->delete($about->gambar);
                }
                $validated['gambar'] = $request->file('gambar')->store('about', 'public');
            }

            $about->fill($validated);
            $about->save();

            return redirect()->back()->with('success', 'Data About berhasil disimpan dengan sukses! 🎉');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.')
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_singkat' => 'nullable|string|max:255',
            'isi_konten' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'judul.required' => 'Judul harus diisi.',
            'judul.max' => 'Judul terlalu panjang (maksimal 255 karakter).',
            'deskripsi_singkat.max' => 'Deskripsi singkat terlalu panjang (maksimal 255 karakter).',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar tidak didukung. Gunakan JPEG, PNG, JPG, GIF, atau WEBP.',
            'gambar.max' => 'Ukuran gambar terlalu besar. Maksimal 5MB (5120 KB).',
        ]);

        try {
            $about = AboutPage::findOrFail($id);

            if ($request->hasFile('gambar')) {
                // Delete old image if exists
                if ($about->gambar && \Storage::disk('public')->exists($about->gambar)) {
                    \Storage::disk('public')->delete($about->gambar);
                }
                $validated['gambar'] = $request->file('gambar')->store('about', 'public');
            }

            $about->update($validated);

            return redirect()->back()->with('success', 'Data About berhasil diperbarui! ✨');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.')
                ->withInput();
        }
    }

    public function showFrontend()
    {
        $about = AboutPage::first();
        return view('website.about', compact('about'));
    }

    public function showPublic()
    {
        $headers = AboutHeader::where('is_active', 1)->get();
        $contents = AboutContent::where('is_active', 1)->orderBy('created_at', 'asc')->get();
        return view('website.about', compact('headers', 'contents'));
    }
}
