@extends('app')

@section('content')
  <h1> Articles </h1>
  <hr>
  @foreach ($articles as $article)
    <article>
      <a href="{{ url('/articles', $article->id) }}"> {{ $article->title }} </a>
      <div>

        {{ $article->body }}
      </div>
    </article>

  @endforeach

  <a href='articles/create'> Make a new article </a>

@stop
