<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestQuoteService;
use Illuminate\Http\Request;

class RequestQuoteServiceController extends Controller
{
    /**
     * Display a listing of services
     */
    public function index()
    {
        $services = RequestQuoteService::orderBy('created_at', 'desc')->get();
        return view('adminui.request_quote_services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service
     */
    public function create()
    {
        return view('adminui.request_quote_services.create');
    }

    /**
     * Store a newly created service
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_service' => 'required|string|max:255|unique:request_quote_services,nama_service',
        ]);

        RequestQuoteService::create([
            'nama_service' => $request->nama_service,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('adminui.request-quote.services.index')
            ->with('success', 'Service berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified service
     */
    public function edit(RequestQuoteService $service)
    {
        return view('adminui.request_quote_services.edit', compact('service'));
    }

    /**
     * Update the specified service
     */
    public function update(Request $request, RequestQuoteService $service)
    {
        $request->validate([
            'nama_service' => 'required|string|max:255|unique:request_quote_services,nama_service,' . $service->id,
        ]);

        $service->update([
            'nama_service' => $request->nama_service,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('adminui.request-quote.services.index')
            ->with('success', 'Service berhasil diperbarui!');
    }

    /**
     * Remove the specified service
     */
    public function destroy(RequestQuoteService $service)
    {
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service berhasil dihapus!'
        ]);
    }

    /**
     * Toggle service status
     */
    public function toggleStatus(RequestQuoteService $service)
    {
        $service->update([
            'status' => !$service->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status service berhasil diperbarui!',
            'status' => $service->status
        ]);
    }
}
