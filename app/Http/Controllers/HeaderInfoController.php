<?php

namespace App\Http\Controllers;

use App\Models\HeaderInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeaderInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar semua header info
     */
    public function index()
    {
        $headerInfos = HeaderInfo::latest()->get();
        return view('adminui.header-info.index', compact('headerInfos'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat header info baru
     */
    public function create()
    {
        return view('adminui.header-info.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data header info baru ke database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_website' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:255',
            'cta_text' => 'required|string|max:255',
            'cta_link' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Buat header info baru
            HeaderInfo::create([
                'nama_website' => $request->nama_website,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'cta_text' => $request->cta_text,
                'cta_link' => $request->cta_link,
                'status' => $request->has('status') ? true : false,
            ]);

            return redirect()->route('adminui.header-info.index')
                ->with('success', 'Header Info berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan Header Info: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     * Menampilkan detail header info tertentu
     */
    public function show(HeaderInfo $headerInfo)
    {
        return view('adminui.header-info.show', compact('headerInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk edit header info
     */
    public function edit(HeaderInfo $headerInfo)
    {
        return view('adminui.header-info.edit', compact('headerInfo'));
    }

    /**
     * Update the specified resource in storage.
     * Update data header info di database
     */
    public function update(Request $request, HeaderInfo $headerInfo)
    {
        $validator = Validator::make($request->all(), [
            'nama_website' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:255',
            'cta_text' => 'required|string|max:255',
            'cta_link' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update header info
            $headerInfo->update([
                'nama_website' => $request->nama_website,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'cta_text' => $request->cta_text,
                'cta_link' => $request->cta_link,
                'status' => $request->has('status') ? true : false,
            ]);

            return redirect()->route('adminui.header-info.index')
                ->with('success', 'Header Info berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate Header Info: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     * Hapus data header info dari database
     */
    public function destroy(HeaderInfo $headerInfo)
    {
        try {
            $headerInfo->delete();

            return redirect()->route('adminui.header-info.index')
                ->with('success', 'Header Info berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus Header Info: ' . $e->getMessage());
        }
    }
}
