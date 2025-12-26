<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display start page with all news items (público - todos pueden ver)
     */
    public function start()
    {
        $newsItems = NewsItem::orderBy('publication_date', 'desc')->get();
        return view('start', compact('newsItems'));
    }

    /**
     * Display the specified news item (público - todos pueden ver)
     */
    public function show(NewsItem $newsItem)
    {
        return view('news.show', compact('newsItem'));
    }

    /**
     * Show the form for creating a new news item (solo admin)
     */
    public function create()
    {
        if (!Auth::user()->admin) {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }
        return view('news.create');
    }

    /**
     * Store a newly created news item (solo admin)
     */
    public function store(Request $request)
    {
        if (!Auth::user()->admin) {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'publication_date' => 'required|date',
        ]);

        // Procesar la imagen si se subió
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $validated['image'] = $path;
        }

        NewsItem::create($validated);
        return redirect()->route('start')->with('success', 'Noticia creada exitosamente');
    }

    /**
     * Show the form for editing the specified news item (solo admin)
     */
    public function edit(NewsItem $newsItem)
    {
        if (!Auth::user()->admin) {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }
        return view('news.edit', compact('newsItem'));
    }

    /**
     * Update the specified news item (solo admin)
     */
    public function update(Request $request, NewsItem $newsItem)
    {
        if (!Auth::user()->admin) {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'publication_date' => 'required|date',
        ]);

        // Procesar nueva imagen si se subió
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($newsItem->image) {
                Storage::disk('public')->delete($newsItem->image);
            }
            $path = $request->file('image')->store('news', 'public');
            $validated['image'] = $path;
        }

        $newsItem->update($validated);
        return redirect()->route('start')->with('success', 'Noticia actualizada exitosamente');
    }

    /**
     * Remove the specified news item (solo admin)
     */
    public function destroy(NewsItem $newsItem)
    {
        if (!Auth::user()->admin) {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }

        // Eliminar imagen si existe
        if ($newsItem->image) {
            Storage::disk('public')->delete($newsItem->image);
        }

        $newsItem->delete();
        return redirect()->route('start')->with('success', 'Noticia eliminada exitosamente');
    }
}