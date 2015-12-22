<?php

namespace App\Http\Controllers;

use App\Article;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

class ArticlesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth', ['only' => 'create']);
    }

    public function index()
    {
      $articles = Article::all();
      return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
      $article = Article::findOrFail($id);

      return view('articles.show', compact('article'));
    }

    public function create()
    {
      return view('articles.create');
    }

    public function store(Requests\CreateArticleRequest $request)
    {
      $article = new Article($request->all());

      \Auth::user()->articles()->save($article);
      return redirect('articles');

    }


}
