@extends('layouts.app')
@section('content')
@foreach($articles as $article)
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="text-center">titre de l'article:{{ $article->name }}</h1>
            <p>contenu de l'article: {{ $article->content}}</p>
        </div>
    </div>
</div>
@endforeach

@endsection