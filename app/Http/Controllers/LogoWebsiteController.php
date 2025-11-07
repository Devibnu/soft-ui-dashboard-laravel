<?php

namespace App\Http\Controllers;

use App\Models\LogoWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LogoWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logos = LogoWebsite::latest()->get();
        return view('adminui.logo-website.index', compact('logos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminui.logo-website.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'status' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Upload gambar
            $path = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = 'logo_website_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('logo-website', $filename, 'public');
            }

            // Simpan ke database
            LogoWebsite::create([
                'gambar' => $path,
                'status' => $request->has('status') ? true : false,
            ]);

            return redirect()->route('adminui.logo-website.index')
                ->with('success', 'Logo Website berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan Logo Website: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogoWebsite $logoWebsite)
    {
        return view('adminui.logo-website.edit', compact('logoWebsite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogoWebsite $logoWebsite)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'status' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = [
                'status' => $request->has('status') ? true : false,
            ];

            // Upload gambar baru jika ada
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($logoWebsite->gambar && Storage::exists('public/' . $logoWebsite->gambar)) {
                    Storage::delete('public/' . $logoWebsite->gambar);
                }

                // Upload gambar baru
                $file = $request->file('gambar');
                $filename = 'logo_website_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('logo-website', $filename, 'public');
                $data['gambar'] = $path;
            }

            $logoWebsite->update($data);

            return redirect()->route('adminui.logo-website.index')
                ->with('success', 'Logo Website berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate Logo Website: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogoWebsite $logoWebsite)
    {
        try {
            $logoWebsite->delete();

            return redirect()->route('adminui.logo-website.index')
                ->with('success', 'Logo Website berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus Logo Website: ' . $e->getMessage());
        }
    }
}
