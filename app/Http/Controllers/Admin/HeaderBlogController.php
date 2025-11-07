<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeaderBlogController extends Controller
{
    /**
     * Display header blog management page
     */
    public function index()
    {
        $headerBlog = HeaderBlog::first();
        return view('adminui.blog.header.index', compact('headerBlog'));
    }

    /**
     * Update or create header blog
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_section' => 'required|string|max:255',
            'deskripsi_section' => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Get or create header blog
            $headerBlog = HeaderBlog::first();
            
            $data = [
                'judul_section' => $request->judul_section,
                'deskripsi_section' => $request->deskripsi_section,
                'status_aktif' => $request->has('status_aktif') ? 1 : 0
            ];
            
            if ($headerBlog) {
                $headerBlog->update($data);
            } else {
                HeaderBlog::create($data);
            }

            return redirect()->route('adminui.blog.header.index')
                ->with('success', 'Header Blog berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan Header Blog: ' . $e->getMessage())
                ->withInput();
        }
    }
}
