<?php

namespace App\Http\Controllers\Api;

use App\Models\Download;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $downloads = Download::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar histori download',
            'data' => $downloads
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required'
        ]);

        $download = Download::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'downloaded_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Riwayat download berhasil disimpan',
            'data' => $download
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $download = Download::find($id);

        if (!$download) {
            return response()->json([
                'success' => false,
                'message' => 'Data download tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail histori download',
            'data' => $download
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $download = Download::find($id);

        if (!$download) {
            return response()->json([
                'success' => false,
                'message' => 'Data download tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required'
        ]);

        $download->update([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'downloaded_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Histori download berhasil diperbarui',
            'data' => $download
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $download = Download::find($id);

        if (!$download) {
            return response()->json([
                'success' => false,
                'message' => 'Data download tidak ditemukan'
            ], 404);
        }

        $download->delete();

        return response()->json([
            'success' => true,
            'message' => 'Histori download berhasil dihapus'
        ]);
    }
}
