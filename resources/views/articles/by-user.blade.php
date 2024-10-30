<x-layout>
    <div class="container my-5">
        <h1 class="text-center mb-4">Articoli scritti da: {{ $user->name }}</h1>
        <div class="row">
            @foreach($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="{{ $article->title }}"
                    style="object-fit: cover; height: 200px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ $article->subtitle }}</p>
                        <p class="card-text"><small class="text-muted">Pubblicato il
                            {{ $article->created_at->format('d/m/Y') }}</small></p>
                            @if ($article->category)
                            <p class="small text-muted">Categoria:
                                <a href="{{route('article.byCategory', $article->category)}}" class="text-capitalize text-muted"> {{$article->category->name }}</a>
                            </p>
                            @else
                            <p class="small text-muted">Nessuna categoria</p>
                            @endif
                            <p class="small text-muted my-0">
                                @foreach ($article->tags as $tag)
                                #{{} $tag->name }}
                                @endforeach
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('articles.show', $article) }}" class="btn btn-primary">Leggi</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        
    </x-layout>
    
    
    
    