<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderProjects;
use Illuminate\Http\Request;

class HeaderProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headerProjects = HeaderProjects::first();
        return view('adminui.projects.header.index', compact('headerProjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminui.projects.header.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_section' => 'required|string|max:255',
            'deskripsi_section' => 'nullable|string',
        ]);

        // Handle checkbox - checked = 1, unchecked = 0
        $validated['status_aktif'] = $request->has('status_aktif') ? 1 : 0;

        HeaderProjects::create($validated);

        return redirect()->route('adminui.projects.header.index')
                         ->with('success', 'Header Projects berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $headerProjects = HeaderProjects::findOrFail($id);
        return view('adminui.projects.header.edit', compact('headerProjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $headerProjects = HeaderProjects::findOrFail($id);

        $validated = $request->validate([
            'judul_section' => 'required|string|max:255',
            'deskripsi_section' => 'nullable|string',
        ]);

        // Handle checkbox - checked = 1, unchecked = 0
        $validated['status_aktif'] = $request->has('status_aktif') ? 1 : 0;

        $headerProjects->update($validated);

        return redirect()->route('adminui.projects.header.index')
                         ->with('success', 'Header Projects berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $headerProjects = HeaderProjects::findOrFail($id);
        $headerProjects->delete();

        return redirect()->route('adminui.projects.header.index')
                         ->with('success', 'Header Projects berhasil dihapus!');
    }
}
