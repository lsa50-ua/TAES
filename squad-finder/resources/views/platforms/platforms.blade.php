@extends('layouts.master')

@section('title', 'Platforms')
@section('content')
    <div class="content-fluid mb-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            @foreach ($platforms as $platform)
            <div class="col">
                {{-- <div class="card text-bg-success"> --}}
                <div class="card border-success" style="margin-top: 2%;">
                    <div class="card-header">
                        @if ($platform->name == "PC" || $platform->name == "Mobile")
                            <img src="{{ asset($platform->image) }}" class="card-img-top" alt="{{ $platform->name }} logo" width="100" height="300">
                        @else
                            <img src="{{ asset($platform->image) }}" class="card-img-top" alt="{{ $platform->name }} logo" width="100" height="100">
                        @endif
                    </div>
                    <div class="card-body">
                        <p>{{ $platform->description }}</p>
                        <p>Compatible games:</p>
                        <div class="list-group">
                            @foreach ($platform->games as $game)
                                {{-- <li class="list-group-item">{{ $game->name }}</li> --}}
                                <a href="{{ route('games.show', $game->id)}}" class="list-group-item list-group-item-action">
                                    <img src="{{ asset($game->img)}}" alt="{{ $game->name }} logo" width="50" height="50" style="margin-right: 1%;">
                                    {{ $game->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
            @endforeach
        </div>
    </div>

@endsection