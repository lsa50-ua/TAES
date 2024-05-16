@extends('layouts.master')

@section('title', 'Friends')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center">Información del amigo</h1>
                    <div class="text-center mb-4">
                        @if($user->url == NULL)
                            <img src="/images/default_avatar.jpg" class="rounded-circle" style="border-radius: 50%; width: 13rem; border: 1px solid #566573;">
                        @else
                            <img src="{{ asset('storage/images/' . $user->id . '.jpg') }}" class="rounded-circle img-fluid" style="border-radius: 50%; width: 13rem; border: 1px solid #566573; object-fit: cover; aspect-ratio: 1 / 1;">
                        @endif
                    </div>
                    <p><strong>Nombre:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
