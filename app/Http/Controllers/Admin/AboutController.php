<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutHeader;
use App\Models\AboutContent;
use App\Models\AboutSection;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    // === ABOUT HEADERS MANAGEMENT ===
    
    /**
     * Display about headers management page
     */
    public function headers()
    {
        $headers = AboutHeader::latest()->paginate(10);
        return view('adminui.about.headers.index', compact('headers'));
    }

    /**
     * Show form to create new header
     */
    public function createHeader()
    {
        return view('adminui.about.headers.create');
    }

    /**
     * Store new header
     */
    public function storeHeader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_active' => 'boolean'
        ], [
            'image.required' => 'Gambar header harus dipilih.',
            'image.image' => 'File harus berupa gambar (jpg, jpeg, png, gif, webp).',
            'image.mimes' => 'Format gambar tidak didukung. Gunakan jpg, jpeg, png, gif, atau webp.',
            'image.max' => 'Ukuran gambar terlalu besar. Maksimal 5MB (5120 KB).'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal mengunggah gambar. Periksa ukuran dan format file.');
        }

        try {
            // Handle file upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/about/headers', 'public');
            }

            // If this header is set as active, deactivate all others
            if ($request->has('is_active') && $request->is_active) {
                AboutHeader::where('is_active', true)->update(['is_active' => false]);
            }

            $header = AboutHeader::create([
                'image_path' => $imagePath,
                'is_active' => $request->has('is_active') ? true : false
            ]);

            return redirect()->route('adminui.about.headers')->with('success', 'Header berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show form to edit header
     */
    public function editHeader(AboutHeader $header)
    {
        return view('adminui.about.headers.edit', compact('header'));
    }

    /**
     * Update header
     */
    public function updateHeader(Request $request, AboutHeader $header)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_active' => 'boolean'
        ], [
            'image.image' => 'File harus berupa gambar (jpg, jpeg, png, gif, webp).',
            'image.mimes' => 'Format gambar tidak didukung. Gunakan jpg, jpeg, png, gif, atau webp.',
            'image.max' => 'Ukuran gambar terlalu besar. Maksimal 5MB (5120 KB).'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal mengunggah gambar. Periksa ukuran dan format file.');
        }

        try {
            // Handle file upload
            $imagePath = $header->image_path;
            if ($request->hasFile('image')) {
                // Delete old image
                if ($header->image_path && Storage::disk('public')->exists($header->image_path)) {
                    Storage::disk('public')->delete($header->image_path);
                }
                $imagePath = $request->file('image')->store('uploads/about/headers', 'public');
            }

            // If this header is set as active, deactivate all others
            if ($request->has('is_active') && $request->is_active) {
                AboutHeader::where('id', '!=', $header->id)->update(['is_active' => false]);
            }

            $header->update([
                'image_path' => $imagePath,
                'is_active' => $request->has('is_active') ? true : false
            ]);

            return redirect()->route('adminui.about.headers')->with('success', 'Header berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Delete header
     */
    public function destroyHeader(AboutHeader $header)
    {
        try {
            // Delete image file
            if ($header->image_path && Storage::disk('public')->exists($header->image_path)) {
                Storage::disk('public')->delete($header->image_path);
            }

            $header->delete();
            return redirect()->route('adminui.about.headers')->with('success', 'Header berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Toggle header status
     */
    public function toggleHeaderStatus(AboutHeader $header)
    {
        try {
            if (!$header->is_active) {
                // If activating this header, deactivate all others
                AboutHeader::where('id', '!=', $header->id)->update(['is_active' => false]);
            }
            
            $header->update(['is_active' => !$header->is_active]);
            
            $status = $header->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->route('adminui.about.headers')->with('success', "Header berhasil {$status}!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // === ABOUT CONTENTS MANAGEMENT ===

    /**
     * Display about contents management page
     */
    public function contents()
    {
        $contents = AboutContent::latest()->paginate(10);
        return view('adminui.about.contents.index', compact('contents'));
    }

    /**
     * Show create content form
     */
    public function createContent()
    {
        return view('adminui.about.content.create');
    }

    /**
     * Store new content
     */
    public function storeContent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:1000',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'cta_link' => 'nullable|url',
            'cta_text' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'is_published' => 'nullable|boolean'
        ], [
            'title.required' => 'Judul konten wajib diisi.',
            'title.max' => 'Judul konten terlalu panjang (maksimal 255 karakter).',
            'short_description.required' => 'Deskripsi singkat wajib diisi.',
            'short_description.max' => 'Deskripsi singkat terlalu panjang (maksimal 1000 karakter).',
            'content.required' => 'Isi konten wajib diisi.',
            'image.image' => 'File harus berupa gambar (jpg, jpeg, png, gif, webp).',
            'image.mimes' => 'Format gambar tidak didukung. Gunakan jpg, jpeg, png, gif, atau webp.',
            'image.max' => 'Ukuran gambar terlalu besar. Maksimal 5MB (5120 KB).',
            'cta_link.url' => 'Link CTA harus berupa URL yang valid.',
            'cta_text.max' => 'Teks tombol CTA terlalu panjang (maksimal 255 karakter).'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menyimpan konten. Periksa data yang diinput.');
        }

        // Validasi logika CTA
        if ($request->filled('cta_link') && !$request->filled('cta_text')) {
            return redirect()->back()
                ->withErrors(['cta_text' => 'Isi teks tombol CTA jika kamu mengisi link CTA.'])
                ->withInput();
        }

        try {
            // Handle file upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/about/contents', 'public');
            }

            $content = AboutContent::create([
                'title' => $request->title,
                'short_description' => $request->short_description,
                'content' => $request->content,
                'image_path' => $imagePath,
                'cta_link' => $request->cta_link,
                'cta_text' => $request->cta_text,
                'is_active' => $request->has('is_active') ? true : false,
                'is_published' => $request->has('is_published') ? true : false
            ]);

            return redirect()->route('adminui.about.contents')->with('success', 'Konten berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show form to edit content
     */
    public function editContent(AboutContent $content)
    {
        return view('adminui.about.content.edit', compact('content'));
    }

    /**
     * Update content
     */
    public function updateContent(Request $request, AboutContent $content)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:1000',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'cta_link' => 'nullable|url',
            'cta_text' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'is_published' => 'nullable|boolean'
        ], [
            'title.required' => 'Judul konten wajib diisi.',
            'title.max' => 'Judul konten terlalu panjang (maksimal 255 karakter).',
            'short_description.required' => 'Deskripsi singkat wajib diisi.',
            'short_description.max' => 'Deskripsi singkat terlalu panjang (maksimal 1000 karakter).',
            'content.required' => 'Isi konten wajib diisi.',
            'image.image' => 'File harus berupa gambar (jpg, jpeg, png, gif, webp).',
            'image.mimes' => 'Format gambar tidak didukung. Gunakan jpg, jpeg, png, gif, atau webp.',
            'image.max' => 'Ukuran gambar terlalu besar. Maksimal 5MB (5120 KB).',
            'cta_link.url' => 'Link CTA harus berupa URL yang valid.',
            'cta_text.max' => 'Teks tombol CTA terlalu panjang (maksimal 255 karakter).'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal memperbarui konten. Periksa data yang diinput.');
        }

        // Validasi logika CTA
        if ($request->filled('cta_link') && !$request->filled('cta_text')) {
            return redirect()->back()
                ->withErrors(['cta_text' => 'Isi teks tombol CTA jika kamu mengisi link CTA.'])
                ->withInput();
        }

        try {
            // Prepare data for update - only update fields that are provided
            $updateData = [
                'title' => $request->title,
                'short_description' => $request->short_description,
                'content' => $request->content,
                'cta_link' => $request->cta_link,
                'cta_text' => $request->cta_text,
                'is_active' => $request->has('is_active') ? true : false,
                'is_published' => $request->has('is_published') ? true : false
            ];

            // Handle file upload only if new image is provided
            if ($request->hasFile('image')) {
                // Delete old image
                if ($content->image_path && Storage::disk('public')->exists($content->image_path)) {
                    Storage::disk('public')->delete($content->image_path);
                }
                $updateData['image_path'] = $request->file('image')->store('uploads/about/contents', 'public');
            }
            // If no new image, keep the existing image_path (don't add to updateData)

            $content->update($updateData);

            return redirect()->route('adminui.about.contents')->with('success', 'Konten berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Delete content
     */
    public function destroyContent(AboutContent $content)
    {
        try {
            // Delete image file
            if ($content->image_path && Storage::disk('public')->exists($content->image_path)) {
                Storage::disk('public')->delete($content->image_path);
            }

            $content->delete();
            return redirect()->route('adminui.about.contents')->with('success', 'Konten berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Toggle content status
     */
    public function toggleContentStatus(AboutContent $content)
    {
        try {
            $content->update(['is_active' => !$content->is_active]);
            
            $status = $content->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->route('adminui.about.contents')->with('success', "Konten berhasil {$status}!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // === COMBINED ABOUT PAGE VIEW ===

    /**
     * Show combined about management dashboard
     */
    public function index()
    {
        $activeHeaders = AboutHeader::active()->count();
        $totalHeaders = AboutHeader::count();
        $activeContents = AboutContent::active()->count();
        $totalContents = AboutContent::count();

        $recentHeaders = AboutHeader::latest()->take(5)->get();
        $recentContents = AboutContent::latest()->take(5)->get();
        
        // Get AboutSection data for hero management
        $aboutSection = AboutSection::first() ?? new AboutSection();
        $testimonials = Testimonial::all();

        return view('adminui.about.index', compact(
            'activeHeaders',
            'totalHeaders', 
            'activeContents', 
            'totalContents',
            'recentHeaders',
            'recentContents',
            'aboutSection',
            'testimonials'
        ));
    }

    /**
     * Update AboutSection hero data
     */
    public function updateHeroSection(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tagline' => 'nullable|string|max:255',
                'hero_title' => 'nullable|string|max:255',
                'hero_subtitle' => 'nullable|string',
                'projects_completed' => 'nullable|integer|min:0',
                'satisfied_customers' => 'nullable|integer|min:0',
                'awards_received' => 'nullable|integer|min:0',
                'years_experience' => 'nullable|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get or create AboutSection record
            $aboutSection = AboutSection::first();
            if (!$aboutSection) {
                $aboutSection = new AboutSection();
            }

            // Update fields
            $aboutSection->tagline = $request->tagline;
            $aboutSection->hero_title = $request->hero_title;
            $aboutSection->hero_subtitle = $request->hero_subtitle;
            $aboutSection->projects_completed = (int) ($request->projects_completed ?? 0);
            $aboutSection->satisfied_customers = (int) ($request->satisfied_customers ?? 0);
            $aboutSection->awards_received = (int) ($request->awards_received ?? 0);
            $aboutSection->years_experience = (int) ($request->years_experience ?? 0);

            $aboutSection->save();

            return response()->json([
                'success' => true,
                'message' => 'Hero section updated successfully!'
            ]);

        } catch (\Exception $e) {
            \Log::error('Hero section update failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving. Please try again.'
            ], 500);
        }
    }

    /**
     * Update testimonials
     */
    public function updateTestimonials(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'testimonials' => 'required|array|min:1',
                'testimonials.*.name' => 'required|string|max:255',
                'testimonials.*.role' => 'required|string|max:255',
                'testimonials.*.message' => 'required|string',
                'testimonials.*.image' => 'nullable|url',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Delete existing testimonials
            Testimonial::truncate();

            // Create new testimonials
            foreach ($request->testimonials as $testimonialData) {
                Testimonial::create([
                    'name' => $testimonialData['name'],
                    'role' => $testimonialData['role'],
                    'message' => $testimonialData['message'],
                    'image' => $testimonialData['image'] ?? null,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Testimonials updated successfully!'
            ]);

        } catch (\Exception $e) {
            \Log::error('Testimonials update failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving. Please try again.'
            ], 500);
        }
    }

    /**
     * Update complete AboutSection data
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:500',
                'tagline' => 'nullable|string|max:255',
                'hero_title' => 'nullable|string|max:255',
                'projects_completed' => 'nullable|integer|min:0',
                'satisfied_customers' => 'nullable|integer|min:0',
                'awards_received' => 'nullable|integer|min:0',
                'years_experience' => 'nullable|integer|min:0',
                'success_title' => 'nullable|string|max:255',
                'success_description' => 'nullable|string',
                'welcome_title' => 'nullable|string|max:255',
                'welcome_paragraph1' => 'nullable|string',
                'welcome_paragraph2' => 'nullable|string',
                'welcome_paragraph3' => 'nullable|string',
                'consultation_title' => 'nullable|string|max:255',
                'consultation_paragraph1' => 'nullable|string',
                'consultation_paragraph2' => 'nullable|string',
                'guidance_title' => 'nullable|string|max:255',
                'video_url' => 'nullable|url',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get or create AboutSection record
            $aboutSection = AboutSection::first();
            if (!$aboutSection) {
                $aboutSection = new AboutSection();
            }

            // Update all fields
            $aboutSection->fill($request->only([
                'email', 'phone', 'address', 'tagline', 'hero_title',
                'projects_completed', 'satisfied_customers', 'awards_received', 'years_experience',
                'success_title', 'success_description', 'welcome_title',
                'welcome_paragraph1', 'welcome_paragraph2', 'welcome_paragraph3',
                'consultation_title', 'consultation_paragraph1', 'consultation_paragraph2',
                'guidance_title', 'video_url'
            ]));

            $aboutSection->save();

            return response()->json([
                'success' => true,
                'message' => 'About section updated successfully!'
            ]);

        } catch (\Exception $e) {
            \Log::error('About section update failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving. Please try again.'
            ], 500);
        }
    }
}