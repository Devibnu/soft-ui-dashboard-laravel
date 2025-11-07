<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Komentar;

class BlogController extends Controller
{
    /**
     * Display blog index page with paginated articles
     */
    public function index()
    {
        $artikels = Artikel::aktif()
            ->orderBy('tanggal_dibuat', 'desc')
            ->paginate(6);

        return view('blog.index', compact('artikels'));
    }

    /**
     * Display specific article detail with comments
     */
    public function detail($slug)
    {
        $artikel = Artikel::where('slug', $slug)
            ->where('status', 'aktif')
            ->firstOrFail();

        // Get approved comments with their replies
        $komentars = Komentar::where('artikel_id', $artikel->id)
            ->utama()
            ->disetujui()
            ->with(['balasan' => function($query) {
                $query->disetujui()->orderBy('tanggal_dibuat', 'asc');
            }])
            ->orderBy('tanggal_dibuat', 'desc')
            ->get();

        return view('blog.detail', compact('artikel', 'komentars'));
    }

    /**
     * Store a new comment for an article
     */
    public function storeKomentar(Request $request, $slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'isi' => 'required|string|max:1000'
        ]);

        $komentar = Komentar::create([
            'artikel_id' => $artikel->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'isi' => $request->isi,
            'status' => 'pending'
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Komentar Anda telah dikirim dan menunggu persetujuan admin.',
                'komentar' => $komentar
            ]);
        }

        return redirect()->back()->with('success', 'Komentar Anda telah dikirim dan menunggu persetujuan admin.');
    }
}
