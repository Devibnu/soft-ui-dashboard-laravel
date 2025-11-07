<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::ordered()->paginate(15);
        return view('adminui.kategori.index', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama',
            'deskripsi' => 'nullable|string|max:500',
            'warna' => 'nullable|string|max:7',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,non_aktif'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);

        Kategori::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama,' . $kategori->id,
            'deskripsi' => 'nullable|string|max:500',
            'warna' => 'nullable|string|max:7',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,non_aktif'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);

        $kategori->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        // Check if kategori has articles
        if ($kategori->artikels()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak dapat dihapus karena masih memiliki ' . $kategori->artikels()->count() . ' artikel'
            ], 400);
        }

        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}
