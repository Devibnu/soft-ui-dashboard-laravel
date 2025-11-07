<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontakController extends Controller
{
    /**
     * Display contact data for admin editing
     */
    public function index()
    {
        $kontak = KontakPerusahaan::first();
        return view('adminui.contact.index', compact('kontak'));
    }

    /**
     * Update contact data
     */
    public function update(Request $request)
    {
        $request->validate([
            'judul_halaman' => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'deskripsi_pesan' => 'nullable|string',
            'map_embed' => 'nullable|string',
            'nomor_whatsapp' => 'nullable|string|max:50',
            'logo_whatsapp' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:300',
        ]);

        $data = $request->only([
            'judul_halaman', 'subjudul', 'alamat', 'telepon', 
            'email', 'deskripsi_pesan', 'map_embed', 'nomor_whatsapp'
        ]);
        $data['status_aktif'] = $request->has('status_aktif');

        // Handle WhatsApp logo upload
        if ($request->hasFile('logo_whatsapp')) {
            $kontak = KontakPerusahaan::first();
            
            // Delete old logo if exists
            if ($kontak && $kontak->logo_whatsapp) {
                Storage::disk('public')->delete($kontak->logo_whatsapp);
            }
            
            $file = $request->file('logo_whatsapp');
            $filename = time() . '_whatsapp_' . $file->getClientOriginalName();
            $path = $file->storeAs('contact/whatsapp', $filename, 'public');
            $data['logo_whatsapp'] = $path;
        }

        $kontak = KontakPerusahaan::first();
        if ($kontak) {
            $kontak->update($data);
            $message = 'Data kontak berhasil diperbarui!';
        } else {
            KontakPerusahaan::create($data);
            $message = 'Data kontak berhasil dibuat!';
        }

        // For AJAX requests
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return redirect()->route('adminui.contact')->with('success', $message);
    }

    /**
     * Display contact page for frontend
     */
    public function frontend()
    {
        $kontak = KontakPerusahaan::first();
        return view('web.contact', compact('kontak'));
    }

    /**
     * Handle contact form submission
     */
    public function submitContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            \App\Models\ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'baru'
            ]);

            \Log::info('Contact form submitted successfully', [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Terima kasih! Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.'
                ]);
            }

            return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim.');
        } catch (\Exception $e) {
            \Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.');
        }
    }
}
