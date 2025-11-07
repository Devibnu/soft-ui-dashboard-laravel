<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = Artikel::orderBy('tanggal_dibuat', 'desc')->paginate(10);
        return view('adminui.blog.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::aktif()->ordered()->get();
        return view('adminui.blog.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string|max:500',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,non_aktif',
            'kategoris' => 'nullable|array',
            'kategoris.*' => 'exists:kategoris,id'
        ]);

        $data = $request->except('kategoris');
        $data['slug'] = Str::slug($request->judul);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('artikel', $imageName, 'public');
            $data['gambar'] = 'artikel/' . $imageName;
        }

        $artikel = Artikel::create($data);

        // Sync kategoris
        if ($request->has('kategoris')) {
            $artikel->kategoris()->sync($request->kategoris);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Artikel berhasil dibuat']);
        }

        return redirect()->route('adminui.blog.index')->with('success', 'Artikel berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $artikel)
    {
        return view('adminui.blog.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        $kategoris = Kategori::aktif()->ordered()->get();
        return view('adminui.blog.edit', compact('artikel', 'kategoris'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string|max:500',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,non_aktif',
            'kategoris' => 'nullable|array',
            'kategoris.*' => 'exists:kategoris,id'
        ]);

        $data = $request->except('kategoris');
        $data['slug'] = Str::slug($request->judul);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }

            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('artikel', $imageName, 'public');
            $data['gambar'] = 'artikel/' . $imageName;
        }

        $artikel->update($data);

        // Sync kategoris
        if ($request->has('kategoris')) {
            $artikel->kategoris()->sync($request->kategoris);
        } else {
            $artikel->kategoris()->sync([]);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Artikel berhasil diupdate']);
        }

        return redirect()->route('adminui.blog.index')->with('success', 'Artikel berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        // Delete image if exists
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return response()->json(['success' => true, 'message' => 'Artikel berhasil dihapus']);
    }

    /**
     * Auto-save functionality
     */
    public function autoSave(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'ringkasan' => 'nullable|string|max:500',
            'isi' => 'nullable|string'
        ]);

        $data = array_filter($request->only(['judul', 'ringkasan', 'isi']));
        
        if (!empty($data)) {
            if (isset($data['judul'])) {
                $data['slug'] = Str::slug($data['judul']);
            }
            $artikel->update($data);
        }

        return response()->json(['success' => true, 'message' => 'Auto-saved']);
    }
}
