<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        return Book::all();
    }

    public function show($id) {
        return Book::findOrFail($id);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer',
            'genre' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        $book = Book::create($validatedData);
        return response()->json($book, 201);
    }
    
    

    public function update(Request $request, $id) {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return response()->json($book, 200);
    }

    public function destroy($id) {
        Book::destroy($id);
        return response()->json(null, 204);
    }
}

