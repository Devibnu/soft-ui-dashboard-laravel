<?php

namespace App\Http\Controllers\AdminUI;

use App\Http\Controllers\Controller;
use App\Models\HeaderLayanan;
use App\Models\FiturUtama;
use App\Models\DaftarLayanan;
use App\Models\HeaderFiturUtama;
use App\Models\HeaderDaftarLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesAdminController extends Controller
{
    /**
     * Display a listing of the resource (old tab-based view).
     */
    public function index()
    {
        $headerLayanan = HeaderLayanan::first();
        $fiturUtamas = FiturUtama::orderBy('created_at', 'desc')->get();
        $daftarLayanans = DaftarLayanan::orderBy('created_at', 'desc')->get();
        
        return view('adminui.services.index', compact('headerLayanan', 'fiturUtamas', 'daftarLayanans'));
    }

    /**
     * Display Fitur Utama page
     */
    public function indexFiturUtama()
    {
        $headerFiturUtama = HeaderFiturUtama::first();
        $fiturUtamas = FiturUtama::orderBy('created_at', 'desc')->paginate(10);
        
        return view('adminui.services.fitur-utama.index', compact('headerFiturUtama', 'fiturUtamas'));
    }

    /**
     * Display Daftar Layanan page
     */
    public function indexDaftarLayanan()
    {
        $headerDaftarLayanan = HeaderDaftarLayanan::first();
        $daftarLayanans = DaftarLayanan::orderBy('created_at', 'desc')->paginate(10);
        
        return view('adminui.services.daftar-layanan.index', compact('headerDaftarLayanan', 'daftarLayanans'));
    }

    /**
     * Store or Update Header Daftar Layanan
     */
    public function storeHeaderDaftarLayanan(Request $request)
    {
        $request->validate([
            'judul_section' => 'required|string|max:255',
            'deskripsi_section' => 'nullable|string',
        ]);

        $data = $request->only(['judul_section', 'deskripsi_section']);
        $data['status_aktif'] = $request->has('status_aktif');

        $headerDaftarLayanan = HeaderDaftarLayanan::first();
        if ($headerDaftarLayanan) {
            $headerDaftarLayanan->update($data);
        } else {
            HeaderDaftarLayanan::create($data);
        }

        return redirect()->route('adminui.services.daftar-layanan.index')->with('success', 'Header Daftar Layanan berhasil disimpan!');
    }

    /**
     * Display Header Layanan page
     */
    public function indexHeaderLayanan()
    {
        $headerLayanan = HeaderLayanan::first();
        
        return view('adminui.services.header-layanan.index', compact('headerLayanan'));
    }

    /**
     * Display Header Fitur Utama page
     */
    public function indexHeaderFiturUtama()
    {
        $headerFiturUtama = HeaderFiturUtama::first();
        
        return view('adminui.services.header-fitur-utama.index', compact('headerFiturUtama'));
    }

    /**
     * Show create form for Fitur Utama
     */
    public function createFiturUtama()
    {
        return view('adminui.services.fitur-utama.create');
    }

    /**
     * Show edit form for Fitur Utama
     */
    public function editFiturUtamaPage($id)
    {
        $fitur = FiturUtama::findOrFail($id);
        return view('adminui.services.fitur-utama.edit', compact('fitur'));
    }

    /**
     * Store Header Layanan
     */
    public function storeHeaderLayanan(Request $request)
    {
        $request->validate([
            'judul_utama' => 'required|string|max:255',
            'gambar_latar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['judul_utama']);
        $data['status_aktif'] = $request->has('status_aktif');

        if ($request->hasFile('gambar_latar')) {
            $file = $request->file('gambar_latar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('services/header', $filename, 'public');
            $data['gambar_latar'] = $path;
        }

        $headerLayanan = HeaderLayanan::first();
        if ($headerLayanan) {
            // Delete old image if new one uploaded
            if ($request->hasFile('gambar_latar') && $headerLayanan->gambar_latar) {
                Storage::disk('public')->delete($headerLayanan->gambar_latar);
            }
            $headerLayanan->update($data);
        } else {
            HeaderLayanan::create($data);
        }

        return redirect()->route('adminui.services.header-layanan.index')->with('success', 'Header Layanan berhasil disimpan!');
    }

    /**
     * Store or Update Header Fitur Utama
     */
    public function storeHeaderFiturUtama(Request $request)
    {
        $request->validate([
            'judul_section' => 'required|string|max:255',
            'deskripsi_section' => 'required|string',
            'gambar_cta' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul_cta' => 'required|string|max:255',
            'deskripsi_cta' => 'required|string',
            'button_text' => 'required|string|max:100',
            'button_url' => 'required|string|max:255',
        ]);

        $data = $request->only(['judul_section', 'deskripsi_section', 'judul_cta', 'deskripsi_cta', 'button_text', 'button_url']);
        $data['status_aktif'] = $request->has('status_aktif');

        if ($request->hasFile('gambar_cta')) {
            $file = $request->file('gambar_cta');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('services/header-fitur-utama', $filename, 'public');
            $data['gambar_cta'] = $path;
        }

        $headerFiturUtama = HeaderFiturUtama::first();
        if ($headerFiturUtama) {
            // Delete old image if new one uploaded
            if ($request->hasFile('gambar_cta') && $headerFiturUtama->gambar_cta) {
                Storage::disk('public')->delete($headerFiturUtama->gambar_cta);
            }
            $headerFiturUtama->update($data);
        } else {
            HeaderFiturUtama::create($data);
        }

        return redirect()->route('adminui.services.header-fitur-utama.index')->with('success', 'Header Fitur Utama berhasil disimpan!');
    }

    /**
     * Store Fitur Utama
     */
    public function storeFiturUtama(Request $request)
    {
        $request->validate([
            'judul_fitur' => 'required|string|max:255',
            'deskripsi_fitur' => 'required|string',
            'ikon_fitur' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['judul_fitur', 'deskripsi_fitur']);
        $data['status_aktif'] = $request->has('status_aktif');

        if ($request->hasFile('ikon_fitur')) {
            $file = $request->file('ikon_fitur');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('services/features', $filename, 'public');
            $data['ikon_fitur'] = $path;
        }

        FiturUtama::create($data);

        return redirect()->route('adminui.services.fitur-utama.index')->with('success', 'Fitur Utama berhasil ditambahkan!');
    }

    /**
     * Store Daftar Layanan
     */
    public function storeDaftarLayanan(Request $request)
    {
        // Check if POST data is too large before validation
        if (empty($_POST) && empty($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0) {
            $displayMaxSize = ini_get('post_max_size');
            return redirect()->back()->with('error', "File terlalu besar! Server hanya mengizinkan maksimal {$displayMaxSize}. Silakan compress gambar terlebih dahulu.");
        }
        
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi_layanan' => 'required|string',
            'harga_layanan' => 'nullable|string|max:255',
            'gambar_layanan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:300',
        ], [
            'gambar_layanan.max' => 'Ukuran gambar tidak boleh lebih dari 300KB.',
            'gambar_layanan.image' => 'File harus berupa gambar.',
            'gambar_layanan.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
        ]);

        $data = $request->only(['nama_layanan', 'deskripsi_layanan', 'harga_layanan']);
        $data['status_aktif'] = $request->has('status_aktif');

        if ($request->hasFile('gambar_layanan')) {
            $file = $request->file('gambar_layanan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('services/layanan', $filename, 'public');
            $data['gambar_layanan'] = $path;
        }

        DaftarLayanan::create($data);

        return redirect()->route('adminui.services.daftar-layanan.index')->with('success', 'Daftar Layanan berhasil ditambahkan!');
    }

    /**
     * Update Fitur Utama
     */
    public function updateFiturUtama(Request $request, $id)
    {
        $fiturUtama = FiturUtama::findOrFail($id);
        
        $request->validate([
            'judul_fitur' => 'required|string|max:255',
            'deskripsi_fitur' => 'required|string',
            'ikon_fitur' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['judul_fitur', 'deskripsi_fitur']);
        $data['status_aktif'] = $request->has('status_aktif');

        if ($request->hasFile('ikon_fitur')) {
            // Delete old icon
            if ($fiturUtama->ikon_fitur) {
                Storage::disk('public')->delete($fiturUtama->ikon_fitur);
            }
            
            $file = $request->file('ikon_fitur');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('services/features', $filename, 'public');
            $data['ikon_fitur'] = $path;
        }

        $fiturUtama->update($data);

        return redirect()->route('adminui.services.fitur-utama.index')->with('success', 'Fitur Utama berhasil diperbarui!');
    }

    /**
     * Update Daftar Layanan
     */
    public function updateDaftarLayanan(Request $request, $id)
    {
        // Check if POST data is too large before validation
        if (empty($_POST) && empty($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0) {
            $displayMaxSize = ini_get('post_max_size');
            return redirect()->back()->with('error', "File terlalu besar! Server hanya mengizinkan maksimal {$displayMaxSize}. Silakan compress gambar terlebih dahulu.");
        }
        
        $daftarLayanan = DaftarLayanan::findOrFail($id);
        
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi_layanan' => 'required|string',
            'harga_layanan' => 'nullable|string|max:255',
            'gambar_layanan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:300',
        ], [
            'gambar_layanan.max' => 'Ukuran gambar tidak boleh lebih dari 300KB.',
            'gambar_layanan.image' => 'File harus berupa gambar.',
            'gambar_layanan.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
        ]);

        $data = $request->only(['nama_layanan', 'deskripsi_layanan', 'harga_layanan']);
        $data['status_aktif'] = $request->has('status_aktif');

        if ($request->hasFile('gambar_layanan')) {
            // Delete old image
            if ($daftarLayanan->gambar_layanan) {
                Storage::disk('public')->delete($daftarLayanan->gambar_layanan);
            }
            
            $file = $request->file('gambar_layanan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('services/layanan', $filename, 'public');
            $data['gambar_layanan'] = $path;
        }

        $daftarLayanan->update($data);

        return redirect()->route('adminui.services.daftar-layanan.index')->with('success', 'Daftar Layanan berhasil diperbarui!');
    }

    /**
     * Delete Fitur Utama
     */
    public function destroyFiturUtama($id)
    {
        try {
            $fiturUtama = FiturUtama::findOrFail($id);
            
            // Delete image file
            if ($fiturUtama->ikon_fitur) {
                Storage::disk('public')->delete($fiturUtama->ikon_fitur);
            }
            
            $fiturUtama->delete();

            return response()->json([
                'success' => true,
                'message' => 'Fitur Utama berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus Fitur Utama: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Edit Fitur Utama (for AJAX)
     */
    public function editFiturUtama($id)
    {
        $fiturUtama = FiturUtama::findOrFail($id);
        return response()->json([
            'id' => $fiturUtama->id,
            'judul_fitur' => $fiturUtama->judul_fitur,
            'deskripsi_fitur' => $fiturUtama->deskripsi_fitur,
            'status_aktif' => $fiturUtama->status_aktif,
            'ikon_fitur' => $fiturUtama->ikon_fitur ? Storage::url($fiturUtama->ikon_fitur) : null,
        ]);
    }

    /**
     * Edit Daftar Layanan (for AJAX)
     */
    public function editDaftarLayanan($id)
    {
        $daftarLayanan = DaftarLayanan::findOrFail($id);
        return response()->json([
            'id' => $daftarLayanan->id,
            'nama_layanan' => $daftarLayanan->nama_layanan,
            'deskripsi_layanan' => $daftarLayanan->deskripsi_layanan,
            'harga_layanan' => $daftarLayanan->harga_layanan,
            'status_aktif' => $daftarLayanan->status_aktif,
            'gambar_layanan' => $daftarLayanan->gambar_layanan ? Storage::url($daftarLayanan->gambar_layanan) : null,
        ]);
    }

    /**
     * Delete Daftar Layanan
     */
    public function destroyDaftarLayanan($id)
    {
        try {
            $daftarLayanan = DaftarLayanan::findOrFail($id);
            
            // Delete image file
            if ($daftarLayanan->gambar_layanan) {
                Storage::disk('public')->delete($daftarLayanan->gambar_layanan);
            }
            
            $daftarLayanan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Daftar Layanan berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus Daftar Layanan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
