<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar buku berhasil diambil',
            'data' => $books
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'      => 'required|integer',
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'publisher'        => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'isbn'             => 'required|string|max:50',
            'cover_image'      => 'nullable|string',
            'file_path'        => 'required|string',
            'description'      => 'nullable|string',
        ]);

        $isbnExists = Book::where('isbn', $request->isbn)->exists();

        if ($isbnExists) {
            return response()->json([
                'success' => false,
                'message' => 'ISBN sudah digunakan'
            ], 422);
        }

        $book = Book::create([
            'category_id'      => $request->category_id,
            'title'            => $request->title,
            'author'           => $request->author,
            'publisher'        => $request->publisher,
            'publication_year' => $request->publication_year,
            'isbn'             => $request->isbn,
            'cover_image'      => $request->cover_image,
            'file_path'        => $request->file_path,
            'description'      => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan',
            'data'    => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('category')->find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail buku berhasil diambil',
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'category_id'      => 'required|integer',
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'publisher'        => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'isbn'             => 'required|string|max:50',
            'cover_image'      => 'nullable|string',
            'file_path'        => 'required|string',
            'description'      => 'nullable|string',
        ]);

        $book->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil diperbarui',
            'data' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus'
        ]);
    }
}
