<?php

namespace App\Http\Controllers\AdminUI;

use App\Http\Controllers\Controller;
use App\Models\HomeHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeHeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroes = HomeHero::orderBy('created_at', 'desc')->paginate(10);
        
        return view('adminui.homehero.index', compact('heroes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminui.homehero.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'tombol_text' => 'nullable|string|max:100',
            'tombol_link' => 'nullable|string|max:255',
            'gambar_background' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'warna_overlay' => 'nullable|string|max:50',
        ]);

        $data = $request->only(['judul', 'subjudul', 'deskripsi', 'tombol_text', 'tombol_link', 'warna_overlay']);
        $data['status'] = $request->has('status');

        if ($request->hasFile('gambar_background')) {
            $file = $request->file('gambar_background');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('home-hero', $filename, 'public');
            $data['gambar_background'] = $path;
        }

        HomeHero::create($data);

        return redirect()->route('adminui.home-hero.index')->with('success', 'Hero berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hero = HomeHero::findOrFail($id);
        return view('adminui.homehero.edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hero = HomeHero::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'tombol_text' => 'nullable|string|max:100',
            'tombol_link' => 'nullable|string|max:255',
            'gambar_background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'warna_overlay' => 'nullable|string|max:50',
        ]);

        $data = $request->only(['judul', 'subjudul', 'deskripsi', 'tombol_text', 'tombol_link', 'warna_overlay']);
        $data['status'] = $request->has('status');

        if ($request->hasFile('gambar_background')) {
            // Delete old image
            if ($hero->gambar_background) {
                Storage::disk('public')->delete($hero->gambar_background);
            }
            
            $file = $request->file('gambar_background');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('home-hero', $filename, 'public');
            $data['gambar_background'] = $path;
        }

        $hero->update($data);

        return redirect()->route('adminui.home-hero.index')->with('success', 'Hero berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $hero = HomeHero::findOrFail($id);
            
            // Delete image file
            if ($hero->gambar_background) {
                Storage::disk('public')->delete($hero->gambar_background);
            }
            
            $hero->delete();

            return response()->json([
                'success' => true,
                'message' => 'Hero berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus Hero: ' . $e->getMessage()
            ], 500);
        }
    }
}
