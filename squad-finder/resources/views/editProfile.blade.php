@extends('layouts.master')

@section('title', 'Profile')
@section('content')
<div class="container mt-4 ">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Edit Profile</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('profile.update', $user->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">New name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">New email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New password:</label>
                    <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm new password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{ route('profile', $user->id) }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection