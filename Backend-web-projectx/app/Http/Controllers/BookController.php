<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $books = Book::all();
        return view('dashboard', compact('books'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addBook');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'isbn' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|integer|min:0',
            'condition' => 'required|string|max:255',
            'cover_image' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'is_available' => 'required|boolean',
            
            // ...otros campos y validaciones...
        ]);
        $validated['user_id'] = auth()->id();
        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Book added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book) {
        return view('showBook', compact('book'));
    }

    public function edit(Book $book) {
        return view('editBook', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            // ...otros campos y validaciones...
        ]);
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Book updated!');
    }

    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted!');
    }
}