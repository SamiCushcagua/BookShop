<?php

namespace App\Http\Controllers;

use App\Models\FAQCategory;
use App\Models\FAQQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FAQController extends Controller
{

    public function admin()
{
    if (!Auth::user()->admin) {
        abort(403, 'No tienes permisos para acceder a esta página.');
        // O puedes redirigir:
        // return redirect()->route('faq.index')->with('error', 'No tienes permisos');
    }

    $categories = FAQCategory::with('questions')->get();
    return view('faq.admin', compact('categories'));
}


    public function index()
    {
        $categories = FAQCategory::with('questions')->get();
        return view('faq.index', compact('categories'));
    }

    public function create()
    {
        $categories = FAQCategory::all();
        return view('faq.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
        ]);

        FAQQuestion::create($validated);
        return redirect()->route('faq.index')->with('success', 'Pregunta FAQ creada exitosamente');
    }

    public function createCategory()
    {
        return view('faq.create-category');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        FAQCategory::create($validated);
        return redirect()->route('faq.index')->with('success', 'Categoría FAQ creada exitosamente');
    }

    public function destroy(FAQQuestion $question)
    {
        $question->delete();
        return redirect()->route('faq.index')->with('success', 'Pregunta eliminada');
    }

    public function destroyCategory(FAQCategory $category)
    {
        $category->delete();
        return redirect()->route('faq.index')->with('success', 'Categoría eliminada');
    }
}