<x-layout>
    <div class="container-fluid p-5 bg-secondary-subtle text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="display-1">Bentornato, Amministratore {{Auth::user()->name}}</h1>
            </div>
        </div>
    </div>
    @if (@session('message'))
        <div class="alert alert-succes">
            {{ session('message') }}
        </div>
        
    @endsession

    
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2>Tutti i tags</h2>
            <x-metainfo-table :metaInfos="$tags" metaType="tags"/>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2>Tutte le categorie</h2>
            <x-metainfo-table :metaInfos="$categories" metaType="categorie"/>
        </div>
    </div>
</div>


<div class="d-flex justify-content-between">
    <h2>Tutte le categorie</h2>
    <form action="{{route('admin.storeCategory')}}" method="POST" class="w-50 d-flex m-3">
        @csrf
        <input type="text" name="name"  class="form-control me-2" placeholder="Inserisci una nuova categoria">
        <button type="submit" class="btn btn-outline-secondary">Inserisci</button>
    </form>
</div>
<x-metainfo-table :metaInfos="$categories" metaType="categorie"/>
    





</x-layout>