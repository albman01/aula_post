<x-layout>
    <div class="container-fluid p-5 bg.-secondary-subtle text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="display-1">Bentornato, Revisore {{Auth::user()->name}}</h1>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Articoli da revisionare</h2>
                <x-articles-table :articles="$unrevisionedArticles"/>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Articoli respinti</h2>
                <x-articles-table :articles="$rejectedArticles"/>
            </div>
        </div>
    </div>
</x-layout>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Sottotilo</th>
            <th scope="col">Redattore</th>
            <th scope="col">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
         <tr>
            <th scope="row">{{$article->id}}</th>
            <td>{{$article->title}}</td>   
            <td>{{$article->subtitle}}</td>  
            <td>{{$article->user->name}}</td>
            
            <td>
                @if (is_null($article->is_accepted))
                    <a href="{{route('articles.show', $article)}}" class="btn btn-secondary">Leggi l'articolo</a>
                    @else
                    <form action="{{route('revisor.undoArticle', $article)}}" method="POST">
                        @csrf
                    <button type="submit" class="btn btn-secondary">Riporta in revisione</button>
                    </form>
                    @endif
            </td>
         </tr>
        @endforeach
    </tbody>
</table>