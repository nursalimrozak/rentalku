<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Article::whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(9);

        $categories = Article::select('category')->distinct()->pluck('category');
        $topArticles = Article::whereNotNull('published_at')->inRandomOrder()->take(3)->get(); // Random for now as "Top"

        return view('blog.index', compact('articles', 'categories', 'topArticles'));
    }

    public function show(Article $article)
    {
        $categories = Article::select('category')->distinct()->pluck('category');
        $topArticles = Article::whereNotNull('published_at')->inRandomOrder()->take(3)->get();
        
        $previousArticle = Article::where('published_at', '<', $article->published_at)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->first();

        $nextArticle = Article::where('published_at', '>', $article->published_at)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'asc')
            ->first();

        return view('blog.show', compact('article', 'categories', 'topArticles', 'previousArticle', 'nextArticle'));
    }
}
