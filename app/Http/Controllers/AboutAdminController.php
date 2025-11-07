<?php

namespace App\Http\Controllers;

use App\Models\AboutHeroSection;
use App\Models\AboutContentSection;
use App\Models\AboutTestimonialSection;
use App\Models\HeroPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutAdminController extends Controller
{
    public function index()
    {
        $heroSection = AboutHeroSection::first();
        $contents = AboutContentSection::latest()->get();
        $testimonials = AboutTestimonialSection::latest()->get();
        $heroPage = HeroPage::first();

        return view('adminui.about.index', compact('heroSection', 'contents', 'testimonials', 'heroPage'));
    }

    public function updateHero(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tagline' => 'required|string|max:255',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'projects_completed' => 'required|integer|min:0',
            'satisfied_customers' => 'required|integer|min:0',
            'awards_received' => 'required|integer|min:0',
            'years_experience' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Get or create hero section
            $heroSection = AboutHeroSection::firstOrNew(['id' => 1]);
            
            // Update basic fields
            $heroSection->tagline = $request->tagline;
            $heroSection->projects_completed = $request->projects_completed;
            $heroSection->satisfied_customers = $request->satisfied_customers;
            $heroSection->awards_received = $request->awards_received;
            $heroSection->years_experience = $request->years_experience;
            
            // Handle hero image upload (only if new file uploaded)
            if ($request->hasFile('hero_image')) {
                \Log::info('Hero image file detected', ['filename' => $request->file('hero_image')->getClientOriginalName()]);
                
                // Delete old image if exists
                if ($heroSection->hero_image && Storage::disk('public')->exists($heroSection->hero_image)) {
                    Storage::disk('public')->delete($heroSection->hero_image);
                    \Log::info('Old hero image deleted', ['path' => $heroSection->hero_image]);
                }
                
                $image = $request->file('hero_image');
                $imageName = 'hero_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('about/hero', $imageName, 'public');
                $heroSection->hero_image = $imagePath;
                
                \Log::info('New hero image uploaded', ['path' => $imagePath]);
            } else {
                \Log::info('No hero image file in request');
            }
            
            $heroSection->save();
            \Log::info('Hero section saved', ['id' => $heroSection->id, 'tagline' => $heroSection->tagline]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Hero section updated successfully!',
                    'data' => $heroSection
                ]);
            }
            
            return redirect()->back()->with('success', 'Hero section updated successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update hero section. Please try again.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to update hero section. Please try again.');
        }
    }

    // === ABOUT CONTENT METHODS ===
    
    /**
     * Show create content form
     */
    public function createContent()
    {
        return view('adminui.about.content.create');
    }

    public function storeContent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'left_paragraph' => 'required|string',
            'right_title' => 'required|string|max:255',
            'right_paragraph' => 'required|string',
            'right_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cta_text' => 'nullable|string|max:255',
            'cta_link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->except('right_image');
            
            if ($request->hasFile('right_image')) {
                $imagePath = $request->file('right_image')->store('about/content', 'public');
                $data['right_image_path'] = $imagePath;
            }

            $content = AboutContentSection::create($data);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Content section saved successfully!',
                    'data' => $content
                ]);
            }
            
            return redirect()->back()->with('success', 'Content section saved successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to save content section. Please try again.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to save content section. Please try again.');
        }
    }

    // === TESTIMONIAL METHODS ===
    
    /**
     * Show create testimonial form
     */
    public function createTestimonial()
    {
        return view('adminui.about.testimonial.create');
    }

    public function storeTestimonial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_title' => 'required|string|max:255',
            'section_subtext' => 'required|string',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'message' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->except('photo');
            
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('about/testimonials', 'public');
                $data['photo_path'] = $photoPath;
            }

            $testimonial = AboutTestimonialSection::create($data);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Testimonial saved successfully!',
                    'data' => $testimonial
                ]);
            }
            
            return redirect()->back()->with('success', 'Testimonial saved successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to save testimonial. Please try again.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to save testimonial. Please try again.');
        }
    }

    /**
     * Show edit content form
     */
    public function editContent(AboutContentSection $content)
    {
        return view('adminui.about.content.edit', compact('content'));
    }

    /**
     * Update content
     */
    public function updateContent(Request $request, AboutContentSection $content)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'left_paragraph' => 'required|string',
            'right_title' => 'required|string|max:255',
            'right_paragraph' => 'required|string',
            'right_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cta_text' => 'nullable|string|max:100',
            'cta_link' => 'nullable|url',
            'is_active' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'title' => $request->title,
                'left_paragraph' => $request->left_paragraph,
                'right_title' => $request->right_title,
                'right_paragraph' => $request->right_paragraph,
                'cta_text' => $request->cta_text,
                'cta_link' => $request->cta_link,
                'is_active' => $request->is_active,
            ];

            // Handle image upload
            if ($request->hasFile('right_image')) {
                // Delete old image if exists
                if ($content->right_image_path && Storage::disk('public')->exists($content->right_image_path)) {
                    Storage::disk('public')->delete($content->right_image_path);
                }
                
                $imagePath = $request->file('right_image')->store('uploads/about/contents', 'public');
                $data['right_image_path'] = $imagePath;
            }

            $content->update($data);

            return redirect()->route('adminui.about.content.index')
                ->with('success', 'Content berhasil diupdate!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal update content: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete content (destroy)
     */
    public function destroyContent(AboutContentSection $content)
    {
        try {
            // Delete image if exists
            if ($content->right_image_path && Storage::disk('public')->exists($content->right_image_path)) {
                Storage::disk('public')->delete($content->right_image_path);
            }
            
            $content->delete();

            return response()->json([
                'success' => true,
                'message' => 'Content berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal hapus content: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteContent($id)
    {
        \Log::info('DeleteContent called with ID: ' . $id);
        
        try {
            $content = AboutContentSection::findOrFail($id);
            \Log::info('Content found: ' . $content->title);
            
            if ($content->right_image_path && Storage::disk('public')->exists($content->right_image_path)) {
                Storage::disk('public')->delete($content->right_image_path);
                \Log::info('Image deleted: ' . $content->right_image_path);
            }
            
            $content->delete();
            \Log::info('Content deleted successfully');

            // Handle both AJAX and form submission
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Content deleted successfully!'
                ]);
            }
            
            return redirect()->back()->with('success', 'Content deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Delete content failed: ' . $e->getMessage());
            
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete content: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to delete content: ' . $e->getMessage());
        }
    }

    /**
     * Show edit testimonial form
     */
    public function editTestimonial(AboutTestimonialSection $testimonial)
    {
        return view('adminui.about.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update testimonial
     */
    public function updateTestimonial(Request $request, AboutTestimonialSection $testimonial)
    {
        $validator = Validator::make($request->all(), [
            'section_title' => 'required|string|max:255',
            'section_subtext' => 'required|string',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'message' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->except(['photo']);

            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
                    Storage::disk('public')->delete($testimonial->photo);
                }
                
                $photoPath = $request->file('photo')->store('uploads/about/testimonials', 'public');
                $data['photo'] = $photoPath;
            }

            $testimonial->update($data);

            return redirect()->route('adminui.about')
                ->with('success', 'Testimonial berhasil diupdate!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal update testimonial: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete testimonial (destroy)
     */
    public function destroyTestimonial(AboutTestimonialSection $testimonial)
    {
        try {
            // Delete photo if exists
            if ($testimonial->photo_path && Storage::disk('public')->exists($testimonial->photo_path)) {
                Storage::disk('public')->delete($testimonial->photo_path);
            }
            
            $testimonial->delete();

            return response()->json([
                'success' => true,
                'message' => 'Testimonial berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus testimonial: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteTestimonial($id)
    {
        \Log::info('DeleteTestimonial called with ID: ' . $id);
        
        try {
            $testimonial = AboutTestimonialSection::findOrFail($id);
            \Log::info('Testimonial found: ' . $testimonial->name);
            
            if ($testimonial->photo_path && Storage::disk('public')->exists($testimonial->photo_path)) {
                Storage::disk('public')->delete($testimonial->photo_path);
                \Log::info('Photo deleted: ' . $testimonial->photo_path);
            }
            
            $testimonial->delete();
            \Log::info('Testimonial deleted successfully');

            // Handle both AJAX and form submission
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Testimonial deleted successfully!'
                ]);
            }
            
            return redirect()->back()->with('success', 'Testimonial deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Delete testimonial failed: ' . $e->getMessage());
            
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete testimonial: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to delete testimonial: ' . $e->getMessage());
        }
    }

    public function updateHeroPage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hero_title' => 'required|string|max:255',
            'hero_background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'breadcrumb_text' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Prepare data
            $data = $request->except(['hero_background']);
            
            // Handle hero background image upload
            if ($request->hasFile('hero_background')) {
                $image = $request->file('hero_background');
                $imageName = 'hero_page_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('about/heropage', $imageName, 'public');
                $data['hero_background'] = $imagePath;
            }
            
            // Delete existing and create new (only one hero page allowed)
            HeroPage::truncate();
            $heroPage = HeroPage::create($data);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Hero page updated successfully!',
                    'data' => $heroPage
                ]);
            }
            
            return redirect()->back()->with('success', 'Hero page updated successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update hero page. Please try again.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to update hero page. Please try again.');
        }
    }

    // Index methods for submenu pages
    public function indexContent()
    {
        $contents = AboutContentSection::latest()->get();
        return view('adminui.about.contents.index', compact('contents'));
    }

    public function indexTestimonial()
    {
        $testimonials = AboutTestimonialSection::latest()->paginate(10);
        return view('adminui.about.testimonials.index', compact('testimonials'));
    }

    public function indexHeaders()
    {
        $headers = HeroPage::latest()->paginate(10);
        return view('adminui.about.headers.index', compact('headers'));
    }

    public function createHeader()
    {
        return view('adminui.about.headers.create');
    }

    public function storeHeader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hero_title' => 'required|string|max:255',
            'hero_background' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'breadcrumb_text' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->except(['hero_background']);
            $data['is_active'] = $request->has('is_active') ? 1 : 0;

            if ($request->hasFile('hero_background')) {
                $imagePath = $request->file('hero_background')->store('uploads/about/headers', 'public');
                $data['hero_background'] = $imagePath;
            }

            HeroPage::create($data);

            return redirect()->route('adminui.about.headers.index')
                ->with('success', 'Header berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan header: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function editHeader(HeroPage $header)
    {
        return view('adminui.about.headers.edit', compact('header'));
    }

    public function updateHeader(Request $request, HeroPage $header)
    {
        $validator = Validator::make($request->all(), [
            'hero_title' => 'required|string|max:255',
            'hero_background' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'breadcrumb_text' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->except(['hero_background']);
            $data['is_active'] = $request->has('is_active') ? 1 : 0;

            if ($request->hasFile('hero_background')) {
                // Delete old image
                if ($header->hero_background && Storage::disk('public')->exists($header->hero_background)) {
                    Storage::disk('public')->delete($header->hero_background);
                }
                
                $imagePath = $request->file('hero_background')->store('uploads/about/headers', 'public');
                $data['hero_background'] = $imagePath;
            }

            $header->update($data);

            return redirect()->route('adminui.about.headers.index')
                ->with('success', 'Header berhasil diupdate!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal update header: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroyHeader(HeroPage $header)
    {
        try {
            // Delete image if exists
            if ($header->hero_background && Storage::disk('public')->exists($header->hero_background)) {
                Storage::disk('public')->delete($header->hero_background);
            }
            
            $header->delete();

            return redirect()->route('adminui.about.headers.index')
                ->with('success', 'Header berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('adminui.about.headers.index')
                ->with('error', 'Gagal menghapus header: ' . $e->getMessage());
        }
    }
}

