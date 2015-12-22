@extends('app')

@section('content')

  <h1> Write a new article </h1>

  <hr/>

  {!! Form::open(['url' => 'articles']) !!}

    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title') !!}


    {!! Form::label('Body', 'Body:') !!}
    {!! Form::textarea('body') !!}

    {!! Form::submit('Add article') !!}


  {!! Form::close() !!}


@stop
