@extends('layouts.master')
@section('title', 'Profile')
@section('content')
@foreach ($users as $user)
  <div class="card mb-3" style="max-width:100%;">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="" class="img-fluid rounded-start" alt="We want to see your face!">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">Profile of {{ $user->name }}</h5>
            <p class="card-text">Here you will be able to check your profile details, even to change them if needed.</p>
            <p class="card-text"><small class="text-body-secondary">Email: {{ $user->email }} </small></p>
            <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('profile.destroy', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your profile?')">Delete</button>
            </form>
          </div>
        </div>
      </div>
  </div>
@endforeach
@endsection