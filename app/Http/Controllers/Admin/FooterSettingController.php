<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;

class FooterSettingController extends Controller
{
    /**
     * Display footer settings form
     */
    public function index()
    {
        $footer = FooterSetting::first();
        
        // If no settings exist, create default
        if (!$footer) {
            $footer = new FooterSetting([
                'alamat' => '203 Fake St. Mountain View, San Francisco, California, USA',
                'telepon' => '+2 392 3929 210',
                'email' => 'info@yourdomain.com',
                'placeholder_subscribe' => 'Enter email address',
                'tombol_subscribe_text' => 'Subscribe',
                'tombol_subscribe_link' => '#',
                'copyright_text' => 'Copyright &copy; ' . date('Y') . ' All rights reserved | This template is made with ♥ by Colorlib'
            ]);
        }
        
        return view('adminui.footer.index', compact('footer'));
    }

    /**
     * Update footer settings
     */
    public function update(Request $request)
    {
        try {
            $request->validate([
                'alamat' => 'required|string',
                'telepon' => 'required|string|max:50',
                'email' => 'required|email|max:255',
                'placeholder_subscribe' => 'required|string|max:255',
                'tombol_subscribe_text' => 'required|string|max:50',
                'tombol_subscribe_link' => 'nullable|string|max:255',
                'facebook_link' => 'nullable|string|max:255',
                'twitter_link' => 'nullable|string|max:255',
                'instagram_link' => 'nullable|string|max:255',
                'linkedin_link' => 'nullable|string|max:255',
                'youtube_link' => 'nullable|string|max:255',
                'copyright_text' => 'required|string'
            ]);

            $footer = FooterSetting::first();
            
            $data = $request->only([
                'alamat', 'telepon', 'email', 
                'placeholder_subscribe', 'tombol_subscribe_text', 'tombol_subscribe_link',
                'facebook_link', 'twitter_link', 'instagram_link', 
                'linkedin_link', 'youtube_link', 'copyright_text'
            ]);

            if ($footer) {
                $footer->update($data);
                $message = 'Footer settings berhasil diperbarui!';
            } else {
                FooterSetting::create($data);
                $message = 'Footer settings berhasil dibuat!';
            }

            \Log::info('Footer settings updated successfully');

            // For AJAX requests
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            }

            return redirect()->route('adminui.footer.index')->with('success', $message);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Footer settings validation failed', ['errors' => $e->errors()]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            \Log::error('Footer settings update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data')->withInput();
        }
    }
}
