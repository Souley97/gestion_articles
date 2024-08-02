<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Article::All();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'title' =>'required|max:255',
            'body' =>'required',
        ]);

        // create and save new article
        $articles = Article::create($request);

        return response()->json($articles, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // message error
        if (!$article) {
            return response()->json(['error' => 'Article no trouvée'], 404);
        }

        // return the article
        return response()->json($article);
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
    // message error et validation
    if (!$article) {
            return response()->json(['error' => 'Article non trouvée'], 404);
        }
        $request->validate([
            'title' =>'required|max:255',
            'body' =>'required',
        ]);

        // update and save the article
        $article->update($request->all());

        return response()->json($article, 200);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
