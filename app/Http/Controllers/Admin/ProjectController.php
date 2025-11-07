<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proyek;
use App\Models\KategoriProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects
     */
    public function index()
    {
        $projects = Proyek::with('kategori')->latest()->paginate(10);
        return view('adminui.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project
     */
    public function create()
    {
        $kategoris = KategoriProject::where('status', 'published')->orderBy('urutan')->orderBy('nama')->get();
        return view('adminui.projects.create', compact('kategoris'));
    }

    /**
     * Store a newly created project
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_project,id',
            'deskripsi_singkat' => 'required|string',
            'deskripsi_lengkap' => 'required|string',
            'gambar_utama' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'klien' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_proyek' => 'nullable|date',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->except(['gambar_utama', 'galeri']);

            // Upload main image
            if ($request->hasFile('gambar_utama')) {
                $gambarPath = $request->file('gambar_utama')->store('projects', 'public');
                $data['gambar_utama'] = $gambarPath;
            }

            // Upload gallery images
            if ($request->hasFile('galeri')) {
                $galeriPaths = [];
                foreach ($request->file('galeri') as $image) {
                    $path = $image->store('projects/gallery', 'public');
                    $galeriPaths[] = $path;
                }
                $data['galeri'] = $galeriPaths;
            }

            Proyek::create($data);

            return redirect()->route('adminui.projects.index')
                ->with('success', 'Project berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan project: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified project
     */
    public function show(Proyek $project)
    {
        return view('adminui.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project
     */
    public function edit(Proyek $project)
    {
        $kategoris = KategoriProject::where('status', 'published')->orderBy('urutan')->orderBy('nama')->get();
        return view('adminui.projects.edit', compact('project', 'kategoris'));
    }

    /**
     * Update the specified project
     */
    public function update(Request $request, Proyek $project)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_project,id',
            'deskripsi_singkat' => 'required|string',
            'deskripsi_lengkap' => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'klien' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_proyek' => 'nullable|date',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->except(['gambar_utama', 'galeri', 'hapus_galeri']);

            // Update main image
            if ($request->hasFile('gambar_utama')) {
                // Delete old image
                if ($project->gambar_utama && Storage::disk('public')->exists($project->gambar_utama)) {
                    Storage::disk('public')->delete($project->gambar_utama);
                }
                
                $gambarPath = $request->file('gambar_utama')->store('projects', 'public');
                $data['gambar_utama'] = $gambarPath;
            }

            // Handle gallery deletion
            if ($request->has('hapus_galeri') && is_array($request->hapus_galeri)) {
                $currentGaleri = $project->galeri ?? [];
                foreach ($request->hapus_galeri as $imagePath) {
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                    $currentGaleri = array_diff($currentGaleri, [$imagePath]);
                }
                $data['galeri'] = array_values($currentGaleri);
            }

            // Add new gallery images
            if ($request->hasFile('galeri')) {
                $currentGaleri = $data['galeri'] ?? $project->galeri ?? [];
                foreach ($request->file('galeri') as $image) {
                    $path = $image->store('projects/gallery', 'public');
                    $currentGaleri[] = $path;
                }
                $data['galeri'] = $currentGaleri;
            }

            $project->update($data);

            return redirect()->route('adminui.projects.index')
                ->with('success', 'Project berhasil diupdate!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal update project: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified project
     */
    public function destroy(Proyek $project)
    {
        try {
            // Delete main image
            if ($project->gambar_utama && Storage::disk('public')->exists($project->gambar_utama)) {
                Storage::disk('public')->delete($project->gambar_utama);
            }

            // Delete gallery images
            if ($project->galeri && is_array($project->galeri)) {
                foreach ($project->galeri as $imagePath) {
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
            }

            $project->delete();

            return response()->json([
                'success' => true,
                'message' => 'Project berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus project: ' . $e->getMessage()
            ], 500);
        }
    }
}
