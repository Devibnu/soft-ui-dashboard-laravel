<?php

namespace App\Http\Controllers;

use App\Models\LogoAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LogoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logos = LogoAdmin::latest()->get();
        return view('adminui.logo-admin.index', compact('logos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminui.logo-admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'nama_perusahaan' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
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
                $filename = 'logo_admin_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('logo-admin', $filename, 'public');
            }

            // Simpan ke database
            LogoAdmin::create([
                'gambar' => $path,
                'nama_perusahaan' => $request->nama_perusahaan,
                'tagline' => $request->tagline,
                'status' => $request->has('status') ? true : false,
            ]);

            return redirect()->route('adminui.logo-admin.index')
                ->with('success', 'Logo Admin berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan Logo Admin: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogoAdmin $logoAdmin)
    {
        return view('adminui.logo-admin.edit', compact('logoAdmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogoAdmin $logoAdmin)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'nama_perusahaan' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'status' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = [
                'nama_perusahaan' => $request->nama_perusahaan,
                'tagline' => $request->tagline,
                'status' => $request->has('status') ? true : false,
            ];

            // Upload gambar baru jika ada
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($logoAdmin->gambar && Storage::exists('public/' . $logoAdmin->gambar)) {
                    Storage::delete('public/' . $logoAdmin->gambar);
                }

                // Upload gambar baru
                $file = $request->file('gambar');
                $filename = 'logo_admin_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('logo-admin', $filename, 'public');
                $data['gambar'] = $path;
            }

            $logoAdmin->update($data);

            return redirect()->route('adminui.logo-admin.index')
                ->with('success', 'Logo Admin berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate Logo Admin: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogoAdmin $logoAdmin)
    {
        try {
            $logoAdmin->delete();

            return redirect()->route('adminui.logo-admin.index')
                ->with('success', 'Logo Admin berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus Logo Admin: ' . $e->getMessage());
        }
    }
}
