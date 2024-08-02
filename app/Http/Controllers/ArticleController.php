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
        $articles = Article::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des articles récupérée avec succès',
            'data' => $articles
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        // create and save new article
        $article = Article::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Article créé avec succès',
            'data' => $article
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // message error
        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article non trouvé'
            ], 404);
        }

        // return the article
        return response()->json([
            'success' => true,
            'message' => 'Article récupéré avec succès',
            'data' => $article
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        // message error et validation
        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article non trouvé'
            ], 404);
        }

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        // update and save the article
        $article->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Article mis à jour avec succès',
            'data' => $article
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // message error
        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article non trouvé'
            ], 404);
        }

        // delete the article
        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article supprimé avec succès'
        ], 204);
    }
}
