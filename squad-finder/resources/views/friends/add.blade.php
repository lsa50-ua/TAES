@extends('layouts.master')

@section('title', 'Addfriends')
@section('content')

<div class="d-flex justify-content-between">
    <form action="{{ route('friends.list') }}" method="GET" class="d-flex" role="search" style="margin-bottom: 1%;">
        <button class="btn btn-outline-success" type="submit">Back</button>
    </form>
    <form action="{{ route('friends.searchNewFriends') }}" method="GET" class="d-flex" role="search" style="margin-bottom: 1%;">
        <input name="search" class="form-control me-2" type="search" style="max-width: 150px;" placeholder="Search" aria-label="Search" value="{{ request('search') }}"> 
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>

@if (session()->has('message'))
        <div class="alert alert-success" style="margin-top: 1%;">
            {{ session()->get('message') }}
        </div>
@endif

@if ($users->isEmpty())
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="info-fill" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
    </svg>  
    <div class="alert alert-danger d-flex align-items-center" role="alert" style="margin-top: 2%;">
        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:"><use xlink:href="#info-fill"></use></svg>
        <div>
            No results found
        </div>
    </div>
@else
    <div class="row" style="margin-top: 1%;">
        <div class="content-fluid" style="margin-top: 2%; margin-bottom: 2%;">
            <div class="row row-cols-3">
                @foreach($users as $user)
                    <div class="col mb-3">
                        <div class="card" style="max-width: 400px; margin-right: 1%">
                            <a href="#" style="text-decoration: none; color: black;">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        @if($user->image == NULL)
                                            <img class="object-fit-cover" src="/images/default_avatar.jpg" style="width: 4rem; height: 4rem;">
                                        @else
                                            <img class="object-fit-cover" src="{{ asset('storage/images/' . $user->id . '.jpg') }}" style="width: 4rem; height: 4rem; ">
                                        @endif
                                    </div>
                                    <div class="col-md-8 d-flex align-items-center">
                                        <div class="card-body" style="padding-left: 0">
                                            <form action="{{ route('friends.store', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <h5 class="card-title d-flex justify-content-between align-items-center" style="margin: 0">
                                                    {{ $user->name }}
                                                    <button type="submit" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Add friend">+</button>
                                                </h5>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endif

@endsection
