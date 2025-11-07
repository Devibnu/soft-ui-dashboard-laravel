<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestQuoteSetting;
use App\Models\RequestQuoteMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RequestQuoteController extends Controller
{
    /**
     * Display settings edit form
     */
    public function index()
    {
        $setting = RequestQuoteSetting::first();
        
        // Create default if not exists
        if (!$setting) {
            $setting = RequestQuoteSetting::create([
                'title' => 'Request A Quote',
                'subtitle' => '<p>Get a personalized consultation for your business needs. Fill out the form below and our team will get back to you shortly.</p>',
                'overlay_color' => 'rgba(0,0,0,0.5)',
                'button_text' => 'Send Message',
                'status' => true
            ]);
        }
        
        return view('adminui.request-quote.index', compact('setting'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $setting = RequestQuoteSetting::first();
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'bg_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'overlay_color' => 'required|string',
            'button_text' => 'required|string|max:100',
        ]);

        // Map deskripsi to subtitle column
        $validated['subtitle'] = $validated['deskripsi'];
        unset($validated['deskripsi']);

        // Handle checkbox
        $validated['status'] = $request->has('status') ? 1 : 0;

        // Handle image upload
        if ($request->hasFile('bg_image')) {
            // Delete old image
            if ($setting->bg_image && Storage::disk('public')->exists($setting->bg_image)) {
                Storage::disk('public')->delete($setting->bg_image);
            }
            
            $path = $request->file('bg_image')->store('request-quote', 'public');
            $validated['bg_image'] = $path;
        }

        $setting->update($validated);

        return redirect()->route('adminui.request-quote.index')
                         ->with('success', 'Request Quote settings updated successfully!');
    }

    /**
     * Display messages list
     */
    public function messages()
    {
        $messages = RequestQuoteMessage::orderBy('created_at', 'desc')->paginate(20);
        return view('adminui.request-quote.messages', compact('messages'));
    }

    /**
     * Delete message
     */
    public function destroyMessage($id)
    {
        $message = RequestQuoteMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('adminui.request-quote.messages')
                         ->with('success', 'Message deleted successfully!');
    }

    /**
     * Public submit form (frontend)
     */
    public function submitQuote(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'service' => 'required|string|max:200',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Save to old table for backward compatibility
        RequestQuoteMessage::create($validated);

        // Also save to new inbox table
        \App\Models\RequestQuoteInbox::create([
            'nama_depan' => $validated['first_name'],
            'nama_belakang' => $validated['last_name'],
            'email' => $validated['email'],
            'nomor_telepon' => $validated['phone'],
            'service_slug' => $validated['service'],
            'pesan' => $validated['message'],
            'status' => 'baru'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Permintaan Anda telah berhasil dikirim. Kami akan menghubungi Anda segera.'
        ]);
    }
}
