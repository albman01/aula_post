<x-layout>
    <div class="container-fluid p-5 bg-secondary-subtle text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="display-1">Bentornato, Revisore {{Auth::user()->name}}</h1>
            </div>
        </div>
        @if (session('message'))
            <div class="alert alert-success">
                {{session('message') }}
            </div>
        @endif