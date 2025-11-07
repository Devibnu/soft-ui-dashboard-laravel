<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();
        
        // Filter by status
        if ($request->has('status') && in_array($request->status, ['baru', 'dibaca', 'selesai'])) {
            $query->where('status', $request->status);
        }
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }
        
        $messages = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Get status counts
        $statusCount = [
            'all' => ContactMessage::count(),
            'baru' => ContactMessage::where('status', 'baru')->count(),
            'dibaca' => ContactMessage::where('status', 'dibaca')->count(),
            'selesai' => ContactMessage::where('status', 'selesai')->count(),
        ];
        
        return view('adminui.contact_messages.index', compact('messages', 'statusCount'));
    }

    /**
     * Display the specified message
     */
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Mark as read if status is 'baru'
        $message->markAsRead();
        
        return view('adminui.contact_messages.show', compact('message'));
    }

    /**
     * Update message status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:baru,dibaca,selesai'
        ]);

        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diupdate',
            'status' => $message->status_label,
            'badge' => $message->status_badge
        ]);
    }

    /**
     * Delete message
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus'
        ]);
    }

    /**
     * Reply via email
     */
    public function replyEmail(Request $request, $id)
    {
        \Log::info('=== replyEmail CALLED (Contact Messages) ===', ['id' => $id]);
        
        try {
            $request->validate(['reply_message' => 'required|string']);
            $message = ContactMessage::findOrFail($id);

            // Check if mail is configured
            $mailHost = env('MAIL_HOST');
            $mailUsername = env('MAIL_USERNAME');
            $devMailHosts = ['mailpit', 'mailhog', 'mailtrap.io', 'sandbox.smtp.mailtrap.io', 'localhost', '127.0.0.1'];
            
            if (empty($mailHost) || empty($mailUsername) || in_array(strtolower($mailHost), $devMailHosts)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fitur email belum dikonfigurasi untuk production.'
                ], 400);
            }

            Mail::send('emails.contact_reply', [
                'customerName' => $message->name,
                'replyMessage' => $request->reply_message,
                'originalSubject' => $message->subject,
                'originalMessage' => $message->message
            ], function ($mail) use ($message) {
                $mail->to($message->email)
                     ->subject('Re: ' . $message->subject . ' - JasaIbnu')
                     ->from(config('mail.from.address'), 'JasaIbnu Support');
            });

            $message->update(['status' => 'selesai']);

            return response()->json([
                'success' => true,
                'message' => 'Email berhasil dikirim ke ' . $message->email
            ]);
        } catch (\Exception $e) {
            \Log::error('Email sending failed (Contact): ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Generate WhatsApp reply link
     */
    public function replyWhatsapp(Request $request, $id)
    {
        $request->validate(['reply_message' => 'required|string']);
        $message = ContactMessage::findOrFail($id);

        $text = "Halo {$message->name},\n\n";
        $text .= "Terima kasih telah menghubungi kami.\n\n";
        $text .= "Re: {$message->subject}\n\n";
        $text .= $request->reply_message;

        $whatsappUrl = 'https://wa.me/?text=' . urlencode($text);
        $message->update(['status' => 'selesai']);

        return response()->json([
            'success' => true,
            'url' => $whatsappUrl,
            'message' => 'Redirect ke WhatsApp...'
        ]);
    }
}
