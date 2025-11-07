<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Validasi ukuran gambar (maks 2MB)
            if ($file->getSize() > 2 * 1024 * 1024) {
                return response()->json([
                    'error' => 'Ukuran gambar terlalu besar (maksimal 2MB).'
                ], 400);
            }

            // Validasi tipe file
            $allowedTypes = ['jpeg', 'jpg', 'png', 'gif', 'webp'];
            $extension = strtolower($file->getClientOriginalExtension());
            
            if (!in_array($extension, $allowedTypes)) {
                return response()->json([
                    'error' => 'Format file tidak didukung. Gunakan JPG, PNG, GIF, atau WEBP.'
                ], 400);
            }

            // Buat direktori jika belum ada
            $uploadPath = public_path('uploads/ckeditor');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $filename = time().'_'.$file->getClientOriginalName();
            $file->move($uploadPath, $filename);

            $url = asset('uploads/ckeditor/'.$filename);

            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
