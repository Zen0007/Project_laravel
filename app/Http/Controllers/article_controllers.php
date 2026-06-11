<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array',
        ]);

        $article = Article::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'tags' => $validated['tags'] ?? [],
        ]);

        return response()->json([
            'success' => true,
            'data' => $article,
        ], 201);
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return response()->json($article);
    }

    public function index()
    {
        return Article::latest()->get();
    }
}
