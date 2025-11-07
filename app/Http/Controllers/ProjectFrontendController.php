<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\KategoriProject;
use Illuminate\Http\Request;

class ProjectFrontendController extends Controller
{
    /**
     * Display a listing of active projects
     */
    public function index(Request $request)
    {
        $query = Proyek::with('kategori')->aktif()->latest();

        // Filter by category if provided
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $projects = $query->paginate(9);
        $categories = KategoriProject::all();

        return view('website.project', compact('projects', 'categories'));
    }

    /**
     * Display the specified project by slug
     */
    public function show($slug)
    {
        $project = Proyek::with('kategori')->where('slug', $slug)->aktif()->firstOrFail();
        
        // Get related projects from same category
        $relatedProjects = Proyek::with('kategori')
            ->aktif()
            ->where('kategori_id', $project->kategori_id)
            ->where('id', '!=', $project->id)
            ->limit(3)
            ->get();

        return view('website.project-single', compact('project', 'relatedProjects'));
    }
}
