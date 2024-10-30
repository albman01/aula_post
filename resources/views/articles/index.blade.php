<x-layout>
    
    <div class="container my-5">
        
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('articles.create') }}" class="btn btn-primary">Crea Nuovo Articolo</a>
            </div>
        </div>
        
        <div class="row justify-content-evenly">
            @foreach ($articles as $article)
            <div class="col-12 col-md-3">
                <div class="card mb-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="Immagine dell'articolo: {{ $article->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-subtitle"> {{ $article->subtitle }} </p>
                            <p class="small text-muted">Categoria:
                                <a href="#" class="text-capitalize text-muted">{{ $article->category->name }}</a>
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            @if ($article->category)
                            <p class="small text-muted">Categoria:
                                <a href="{{route('articles.byCategory', $article->category)}}" class="text-capitalize text-muted"> {{$article->category->name }}</a>
                            </p>
                            @else
                            <p class="small text-muted">Nessuna categoria</p>
                            @endif
                            <p class="small text-muted my-0">
                                @foreach ($article->tags as $tag)
                                #{{ $tag->name }}
                                @endforeach
                            </p>
                            <p>Redatto il {{ $article->created_at->format('d/m/Y') }}<br>
                                da {{ $article->user->name }} </p>
                                <a href="{{route('articles.show', $article)}}" class="btn btn-outline-secondary">Leggi</a>
                                <p class="small text-muted">Categoria:
                                    <a href="{{route('articles.byCategory', $article->category)}}" class="text-capitalize fw-bold text-muted">{{ $article->category->name }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
    </x-layout>
    