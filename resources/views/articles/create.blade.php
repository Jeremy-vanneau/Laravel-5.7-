@extends('layouts.app')
@section('content')
    <h3 class="jumbotron text-center">Ajouter un article</h3>
    <div class="container">
        <form method="post" action="{{route('store_article')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group ">
                    <label for="name">Titre de l'article:</label>
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="row">
                <div class="form-group ">
                    <label for="extract">Extrait de l'article:</label>
                    <input type="text" class="form-control" name="extract">
                </div>
            </div>
            <div class="row">
                <div class="form-group ">
                    <label for="content">Contenu de l'article:</label>
                    <textarea type="text" class="form-control" name="content"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group " style="margin-top:60px">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
