<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutSection;
use App\Models\Testimonial;

class DynamicAboutController extends Controller
{
    /**
     * Display the public About page
     */
    public function index()
    {
        $aboutSection = AboutSection::first();
        $testimonials = Testimonial::all();
        
        return view('about', compact('aboutSection', 'testimonials'));
    }

    /**
     * Show the admin edit form
     */
    public function edit()
    {
        $aboutSection = AboutSection::first();
        $testimonials = Testimonial::all();
        
        return view('admin.about_edit', compact('aboutSection', 'testimonials'));
    }

    /**
     * Handle AJAX auto-save updates
     */
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'tagline' => 'nullable|string|max:255',
                'hero_title' => 'nullable|string|max:255',
                'hero_subtitle' => 'nullable|string',
                'projects_completed' => 'nullable|integer|min:0',
                'satisfied_customers' => 'nullable|integer|min:0',
                'awards_received' => 'nullable|integer|min:0',
                'years_experience' => 'nullable|integer|min:0',
            ]);

            $aboutSection = AboutSection::first();
            
            if (!$aboutSection) {
                $aboutSection = AboutSection::create($validated);
            } else {
                $aboutSection->update($validated);
            }

            return response()->json([
                'success' => true,
                'message' => 'Auto-saved successfully',
                'timestamp' => now()->format('H:i:s')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Auto-save failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload image for CKEditor
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:5120' // 5MB max
        ]);

        try {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('about-images', $filename, 'public');
            $url = asset('storage/' . $path);

            return response()->json([
                'url' => $url
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Upload failed: ' . $e->getMessage()
                ]
            ], 500);
        }
    }
}
