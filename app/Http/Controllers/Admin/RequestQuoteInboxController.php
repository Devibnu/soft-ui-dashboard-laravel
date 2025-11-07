<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestQuoteInbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RequestQuoteInboxController extends Controller
{
    /**
     * Display a listing of inbox messages
     */
    public function index(Request $request)
    {
        $query = RequestQuoteInbox::with('service')
            ->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_depan', 'like', "%{$search}%")
                  ->orWhere('nama_belakang', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nomor_telepon', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $messages = $query->paginate(10);

        // Count by status
        $statusCount = [
            'all' => RequestQuoteInbox::count(),
            'baru' => RequestQuoteInbox::where('status', 'baru')->count(),
            'dibaca' => RequestQuoteInbox::where('status', 'dibaca')->count(),
            'selesai' => RequestQuoteInbox::where('status', 'selesai')->count(),
        ];

        return view('adminui.request_quote_inbox.index', compact('messages', 'statusCount'));
    }

    /**
     * Display the specified message
     */
    public function show($id)
    {
        $message = RequestQuoteInbox::with('service')->findOrFail($id);

        // Auto mark as dibaca if status is baru
        if ($message->status === 'baru') {
            $message->update(['status' => 'dibaca']);
        }

        return view('adminui.request_quote_inbox.show', compact('message'));
    }

    /**
     * Update message status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:baru,dibaca,selesai'
        ]);

        $message = RequestQuoteInbox::findOrFail($id);
        $message->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'status' => $message->status,
            'badge' => $message->status_badge
        ]);
    }

    /**
     * Send email reply
     */
    public function replyEmail(Request $request, $id)
    {
        \Log::info('=== replyEmail CALLED ===', [
            'id' => $id,
            'has_reply_message' => $request->has('reply_message'),
            'reply_message_length' => strlen($request->input('reply_message', '')),
            'timestamp' => now()->toDateTimeString()
        ]);
        
        try {
            $request->validate([
                'reply_message' => 'required|string'
            ]);

            $message = RequestQuoteInbox::findOrFail($id);
            
            \Log::info('Message found:', [
                'message_id' => $message->id,
                'email' => $message->email,
                'name' => $message->full_name
            ]);

            // Check if mail is configured properly
            $mailHost = env('MAIL_HOST');
            $mailUsername = env('MAIL_USERNAME');
            
            \Log::info('Email config check:', [
                'host' => $mailHost,
                'username' => $mailUsername,
                'empty_host' => empty($mailHost),
                'empty_username' => empty($mailUsername)
            ]);
            
            // List of development/testing mail hosts that shouldn't be used in production
            $devMailHosts = ['mailpit', 'mailhog', 'mailtrap.io', 'sandbox.smtp.mailtrap.io', 'localhost', '127.0.0.1'];
            
            if (empty($mailHost) || empty($mailUsername) || in_array(strtolower($mailHost), $devMailHosts)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fitur email belum dikonfigurasi untuk production. Silakan gunakan tombol <strong>WhatsApp</strong> untuk membalas pesan.'
                ], 400);
            }

            Mail::send('emails.quote_reply', [
                'customerName' => $message->full_name,
                'replyMessage' => $request->reply_message,
                'originalMessage' => $message->pesan,
                'service' => $message->service->nama_service ?? $message->service_slug
            ], function ($mail) use ($message) {
                $mail->to($message->email)
                     ->subject('Response to your Quote Request - JasaIbnu')
                     ->from(config('mail.from.address'), 'JasaIbnu - Digital Solutions')
                     ->replyTo(config('mail.from.address'), 'JasaIbnu Support');
            });

            // Update status to selesai
            $message->update(['status' => 'selesai']);

            return response()->json([
                'success' => true,
                'message' => 'Email berhasil dikirim ke ' . $message->email
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate WhatsApp reply link
     */
    public function replyWhatsapp(Request $request, $id)
    {
        $request->validate([
            'reply_message' => 'required|string'
        ]);

        $message = RequestQuoteInbox::findOrFail($id);

        // Clean phone number (remove +, spaces, etc)
        $phone = preg_replace('/[^0-9]/', '', $message->nomor_telepon);
        
        // Add country code if not present (assuming Indonesia +62)
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        } elseif (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }

        $replyText = "Halo {$message->full_name},\n\n{$request->reply_message}\n\nTerima kasih,\nJasaIbnu Team";
        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($replyText);

        // Update status to selesai
        $message->update(['status' => 'selesai']);

        return response()->json([
            'success' => true,
            'whatsapp_url' => $whatsappUrl
        ]);
    }

    /**
     * Delete message
     */
    public function destroy($id)
    {
        $message = RequestQuoteInbox::findOrFail($id);
        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus'
        ]);
    }
}
