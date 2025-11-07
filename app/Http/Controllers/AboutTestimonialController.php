<?php

namespace App\Http\Controllers;

use App\Models\AboutTestimonialSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutTestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = AboutTestimonialSection::latest()->get();
        return view('adminui.about.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminui.about.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->except('photo');
            
            // Handle photo upload
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('about/testimonials', 'public');
                $data['photo_path'] = $photoPath;
            }

            $testimonial = AboutTestimonialSection::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Testimonial saved successfully!',
                'data' => $testimonial
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save testimonial. Please try again.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimonial = AboutTestimonialSection::findOrFail($id);
        return view('adminui.about.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testimonial = AboutTestimonialSection::findOrFail($id);
        return view('adminui.about.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $testimonial = AboutTestimonialSection::findOrFail($id);
            $data = $request->except('photo');
            
            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($testimonial->photo_path && Storage::disk('public')->exists($testimonial->photo_path)) {
                    Storage::disk('public')->delete($testimonial->photo_path);
                }
                
                $photoPath = $request->file('photo')->store('about/testimonials', 'public');
                $data['photo_path'] = $photoPath;
            }

            $testimonial->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Testimonial updated successfully!',
                'data' => $testimonial
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update testimonial. Please try again.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $testimonial = AboutTestimonialSection::findOrFail($id);
            
            // Delete associated photo
            if ($testimonial->photo_path && Storage::disk('public')->exists($testimonial->photo_path)) {
                Storage::disk('public')->delete($testimonial->photo_path);
            }
            
            $testimonial->delete();

            return response()->json([
                'success' => true,
                'message' => 'Testimonial deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete testimonial. Please try again.'
            ], 500);
        }
    }
}
