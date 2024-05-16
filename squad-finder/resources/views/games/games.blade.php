@extends('layouts.master')

@section('title', 'Games')
@section('content')
    <div class="d-flex justify-content-between mb-4">
        <form action="{{ route('games.search')}}" method="GET" class="d-flex" role="search">
            <input name="search" class="form-control me-2" type="search" style="max-width: 150px;" placeholder="Search" aria-label="Search" value="{{ request('search') }}"> 
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>


    <form action="{{ route('games.filter') }}" method="GET" class="d-flex align-items-center">        
        <label for="order_by" class="col-sm-1 col-form-label mr-2">Order by</label>
        <div class="col-sm-1">
            <select name="order_by" id="order_by" class="form-control mr-3" style="max-width: 150px;">
            <option value="name" {{ Request::get('order_by') == 'name' ? 'selected' : '' }}>Name</option>
            <option value="id" {{ Request::get('order_by') == 'id' ? 'selected' : '' }}>Old</option>
            <option value="new" {{ Request::get('order_by') == 'new' ? 'selected' : '' }}>New</option>
            </select>
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary">Order</button>
        </div>
    </form>

    



    <div class="container text-center mt-4">
        <div class="row">
            @foreach($games as $game)
            <div class="col-md-4 mb-5 text-center">
                <div class="card h-100">
                    <a href="{{ route('games.show', ['id' => $game->id]) }}">
                        <img src="{{ asset($game->img) }}" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title">{{ $game->name }}</h2>
                        <p class="card-text flex-grow-1">{{ $game->description }}</p>
                        <a href="{{ route('games.show', ['id' => $game->id]) }}" class="btn btn-primary">View Game</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection




