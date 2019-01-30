@extends('layouts.app')
@section('content')
    <h3 class="jumbotron text-center">Editer un article</h3>
    <div class="container">
        {!! Form::model($article, [
            'url' => route('update_article', $article),
            'method' => 'PUT'
        ]) !!}
        <div class="form-group">
            <label for="">Titre de l'article</label>
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <label for="extract">Extrait de l'article</label>
            {{ Form::textarea('extract', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <label for="">Contenu de l'article</label>
            {{ Form::textarea('content', null, ['class' => 'form-control']) }}
        </div>
            {{ Form::submit('Sauvegarder', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}
    </div>
@endsection
