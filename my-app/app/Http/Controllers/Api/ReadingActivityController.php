<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReadingActivity;

class ReadingActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = ReadingActivity::all();

        return response()->json([

            'success' => true,

            'message' => 'Daftar aktivitas membaca',

            'data' => $activities

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'last_page' => 'required|integer',
            'started_at' => 'nullable|date',
            'finished_at' => 'nullable|date',
        ]);

        $activity = ReadingActivity::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'last_page' => $request->last_page,
            'started_at' => $request->started_at,
            'finished_at' => $request->finished_at,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Aktivitas membaca berhasil ditambahkan',
            'data' => $activity
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $activity = ReadingActivity::find($id);

        if (!$activity) {
            return response()->json([
                'success' => false,
                'message' => 'Aktivitas membaca tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'last_page' => 'required|integer|min:0',
            'started_at' => 'nullable|date',
            'finished_at' => 'nullable|date',
        ]);

        $activity->update([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'last_page' => $request->last_page,
            'started_at' => $request->started_at,
            'finished_at' => $request->finished_at,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Aktivitas membaca berhasil diperbarui',
            'data' => $activity
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = ReadingActivity::find($id);

        if (!$activity) {
            return response()->json([
                'success' => false,
                'message' => 'Aktivitas membaca tidak ditemukan'
            ], 404);
        }

        $activity->delete();

        return response()->json([
            'success' => true,
            'message' => 'Aktivitas membaca berhasil dihapus'
        ]);
    }
}
