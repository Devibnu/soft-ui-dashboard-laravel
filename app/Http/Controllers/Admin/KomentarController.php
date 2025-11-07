<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Artikel;

class KomentarController extends Controller
{
    /**
     * Display a listing of comments
     */
    public function index()
    {
        $komentars = Komentar::with(['artikel', 'parent'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('adminui.komentar.index', compact('komentars'));
    }

    /**
     * Approve a comment
     */
    public function approve(Komentar $komentar)
    {
        $komentar->update(['status' => 'disetujui']);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil disetujui'
        ]);
    }

    /**
     * Reject/Pending a comment
     */
    public function reject(Komentar $komentar)
    {
        $komentar->update(['status' => 'pending']);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil ditolak/pending'
        ]);
    }

    /**
     * Store admin reply to a comment
     */
    public function reply(Request $request, Komentar $komentar)
    {
        $request->validate([
            'isi' => 'required|string|max:1000'
        ]);

        $balasan = Komentar::create([
            'artikel_id' => $komentar->artikel_id,
            'nama' => 'Admin',
            'email' => 'admin@jasaibnu.id',
            'isi' => $request->isi,
            'status' => 'disetujui',
            'parent_id' => $komentar->id
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Balasan berhasil dikirim',
                'balasan' => $balasan
            ]);
        }

        return redirect()->back()->with('success', 'Balasan berhasil dikirim');
    }

    /**
     * Delete a comment
     */
    public function destroy(Komentar $komentar)
    {
        $komentar->delete();

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dihapus'
        ]);
    }

    /**
     * Show comments for specific article
     */
    public function byArtikel(Artikel $artikel)
    {
        $komentars = Komentar::where('artikel_id', $artikel->id)
            ->with(['parent', 'balasan'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('adminui.komentar.by-artikel', compact('komentars', 'artikel'));
    }
}
