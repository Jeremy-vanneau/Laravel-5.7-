@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <a href="{{ route('create_article') }}" class="btn btn-success">Ajouter un Article</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <table class="table">
                <thead>
                <tr>
                    <th>Voir l'article</th>
                    <th>Titre</th>
                    <th>Extrait de l'article</th>
                    <th>Date modification</th>
                    <th>Date création</th>
                    <th>Editer</th>
                    <th>Supprimer</th>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td><a href="{{ route('show_article', $article->id) }}" class="btn btn-primary">Lire l'article</a></td>
                        <td>{{ $article->name }}</td>
                        <td>{{ $article->extract }}</td>
                        <td>{{ $article->updated_at }}</td>
                        <td>{{ $article->created_at }}</td>
                        <td><a href="{{ route('edit_article', $article) }}" class="btn btn-primary">Editer</a></td>
                        <td><a href="{{ route('destroy_article', $article) }}" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{$articles->links()}}
        </div>
    </div>
</div>
@endsection