<?php

namespace App\Http\Controllers;

use App\Models\FaviconWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaviconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favicons = FaviconWebsite::latest()->get();
        return view('adminui.favicon.index', compact('favicons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminui.favicon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'favicon' => 'required|image|mimes:png,ico,jpg,jpeg|max:2048',
            'status' => 'nullable'
        ]);

        // Generate unique filename
        $filename = 'favicon_' . time() . '.' . $request->file('favicon')->getClientOriginalExtension();
        
        // Store file
        $path = $request->file('favicon')->storeAs('favicon', $filename, 'public');

        // Create favicon record
        FaviconWebsite::create([
            'favicon' => $path,
            'status' => $request->has('status') ? true : false
        ]);

        return redirect()->route('adminui.favicon.index')
            ->with('success', 'Favicon berhasil diupload!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FaviconWebsite $favicon)
    {
        return redirect()->route('adminui.favicon.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaviconWebsite $favicon)
    {
        return view('adminui.favicon.edit', compact('favicon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FaviconWebsite $favicon)
    {
        $request->validate([
            'favicon' => 'nullable|image|mimes:png,ico,jpg,jpeg|max:2048',
            'status' => 'nullable'
        ]);

        $data = [
            'status' => $request->has('status') ? true : false
        ];

        // If new favicon uploaded
        if ($request->hasFile('favicon')) {
            // Delete old favicon
            if ($favicon->favicon && Storage::disk('public')->exists($favicon->favicon)) {
                Storage::disk('public')->delete($favicon->favicon);
            }

            // Generate unique filename
            $filename = 'favicon_' . time() . '.' . $request->file('favicon')->getClientOriginalExtension();
            
            // Store new file
            $path = $request->file('favicon')->storeAs('favicon', $filename, 'public');
            $data['favicon'] = $path;
        }

        $favicon->update($data);

        return redirect()->route('adminui.favicon.index')
            ->with('success', 'Favicon berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaviconWebsite $favicon)
    {
        // Delete file from storage
        if ($favicon->favicon && Storage::disk('public')->exists($favicon->favicon)) {
            Storage::disk('public')->delete($favicon->favicon);
        }

        $favicon->delete();

        return redirect()->route('adminui.favicon.index')
            ->with('success', 'Favicon berhasil dihapus!');
    }
}
