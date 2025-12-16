<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = \App\Models\Article::latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image' => 'required|image',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('article_images', 'public');
        }

        \App\Models\Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    public function edit(\App\Models\Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, \App\Models\Article $article)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image' => 'nullable|image',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);
        if ($request->hasFile('image')) {
            if ($article->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('article_images', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(\App\Models\Article $article)
    {
        if ($article->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($article->image);
        }
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    }
}
