@extends('app')

@section('content')

  <div>
    <h2> {{ $article->title }} </h2>
    <h3> By: {{ $article->user->name }} </h3>
    <p> {{ $article-> body }} </p>

  </div>

  <a href="/articles"> Index </a>

@stop
