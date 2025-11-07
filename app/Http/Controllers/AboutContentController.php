<?php

namespace App\Http\Controllers;

use App\Models\AboutContentSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = AboutContentSection::latest()->get();
        return view('adminui.about.content.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminui.about.content.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->except('right_image');
            
            // Handle image upload
            if ($request->hasFile('right_image')) {
                $imagePath = $request->file('right_image')->store('about/content', 'public');
                $data['right_image_path'] = $imagePath;
            }

            $content = AboutContentSection::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Content section saved successfully!',
                'data' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save content section. Please try again.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $content = AboutContentSection::findOrFail($id);
        return view('adminui.about.content.show', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $content = AboutContentSection::findOrFail($id);
        return view('adminui.about.content.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $content = AboutContentSection::findOrFail($id);
            $data = $request->except('right_image');
            
            // Handle image upload
            if ($request->hasFile('right_image')) {
                // Delete old image if exists
                if ($content->right_image_path && Storage::disk('public')->exists($content->right_image_path)) {
                    Storage::disk('public')->delete($content->right_image_path);
                }
                
                $imagePath = $request->file('right_image')->store('about/content', 'public');
                $data['right_image_path'] = $imagePath;
            }

            $content->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Content section updated successfully!',
                'data' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update content section. Please try again.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $content = AboutContentSection::findOrFail($id);
            
            // Delete associated image
            if ($content->right_image_path && Storage::disk('public')->exists($content->right_image_path)) {
                Storage::disk('public')->delete($content->right_image_path);
            }
            
            $content->delete();

            return response()->json([
                'success' => true,
                'message' => 'Content section deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete content section. Please try again.'
            ], 500);
        }
    }
}
