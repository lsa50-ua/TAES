@extends('layouts.master')

@section('title', $game->name)
@section('content')
    <div class="container mt-5">
        @if($game)
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <img src="{{ asset($game->img) }}" class="img-fluid rounded" style="width: 100%; height: auto; object-fit: cover;">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-4 mb-4">{{ $game->name }}</h1>
                    <div class="bg-primary p-4 rounded">
                        <p class="text-white mb-2"><strong>Fecha de creación:</strong> {{ $game->creationDate }}</p>
                        <p class="text-white"><strong>Descripción:</strong></p>
                        <p class="text-white">{{ $game->description }}</p>
                    </div>
                    @if(Auth::check() && auth()->user()->isAdmin)
                    <form action="{{ route('game.delete', ['id' => $game->id]) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar juego</button>
                    </form>
                    @endif
                </div>
            </div>
        @else
            <div class="text-center mt-5">
                <p>El juego que intentas mostrar no existe.</p>
            </div>
        @endif
    </div>
@endsection
