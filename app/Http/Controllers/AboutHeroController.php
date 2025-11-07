<?php

namespace App\Http\Controllers;

use App\Models\AboutHeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutHeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroSection = AboutHeroSection::first();
        return view('adminui.about.hero.index', compact('heroSection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminui.about.hero.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tagline' => 'required|string|max:255',
            'projects_completed' => 'required|integer|min:0',
            'satisfied_customers' => 'required|integer|min:0',
            'awards_received' => 'required|integer|min:0',
            'years_experience' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Delete existing record if any (since we only need one hero section)
            AboutHeroSection::truncate();
            
            $heroSection = AboutHeroSection::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Hero section saved successfully!',
                'data' => $heroSection
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save hero section. Please try again.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $heroSection = AboutHeroSection::findOrFail($id);
        return view('adminui.about.hero.show', compact('heroSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $heroSection = AboutHeroSection::findOrFail($id);
        return view('adminui.about.hero.edit', compact('heroSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tagline' => 'required|string|max:255',
            'projects_completed' => 'required|integer|min:0',
            'satisfied_customers' => 'required|integer|min:0',
            'awards_received' => 'required|integer|min:0',
            'years_experience' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $heroSection = AboutHeroSection::findOrFail($id);
            $heroSection->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Hero section updated successfully!',
                'data' => $heroSection
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update hero section. Please try again.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $heroSection = AboutHeroSection::findOrFail($id);
            $heroSection->delete();

            return response()->json([
                'success' => true,
                'message' => 'Hero section deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete hero section. Please try again.'
            ], 500);
        }
    }
}
