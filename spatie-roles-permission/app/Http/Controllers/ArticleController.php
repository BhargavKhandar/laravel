<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:View article', only: ['index']),
            new Middleware('permission:Create article', only: ['create']),
            new Middleware('permission:Edit article', only: ['edit']),
            new Middleware('permission:Delete article', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['articles'] = Article::latest()->paginate(10);
        return view('article.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:255',
            'author' => 'required|min:5|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $article = new Article();
        $article->title = !empty($request->title) ? $request->title : null;
        $article->text = !empty($request->text) ? $request->text : null;
        $article->author = !empty($request->author) ? $request->author : null;
        $article->save();

        return redirect()->route('article')->with('success', 'Article created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['article'] = Article::find($id);
        return view('article.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:255',
            'author' => 'required|min:5|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $article = Article::find($id);
        $article->title = !empty($request->title) ? $request->title : null;
        $article->text = !empty($request->text) ? $request->text : null;
        $article->author = !empty($request->author) ? $request->author : null;
        $article->save();

        return redirect()->route('article')->with('success', 'Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Article::destroy($id);
        return redirect()->route('article')->with('success', 'Article deleted successfully');
    }
}
