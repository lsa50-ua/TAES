@extends('layouts.master')

@section('title', 'Profile')
@section('content')
<div class="card mb-3" style="max-width:100%; margin-top: 5%;">
  <div class="row g-0">
    <div class="col-md-4">
      @if ($user->image == null)
        <img src="{{ asset('storage/images/default.jpg') }}" class="img-fluid rounded-start" alt="We want to see your face!">
      @else
        <img src="{{ asset('storage/images/' . $user->id . '.jpg') }}" class="img-fluid rounded-start" alt="We want to see your face!">
      @endif
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Profile of {{ $user->name }}</h5>
        <p class="card-text">Here you will be able to check your profile details, even to change them if needed.</p>
        <p class="card-text"><small class="text-body-secondary">Email: {{ $user->email }} </small></p>
        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Edit</a><br><br>
        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="image" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <br><br>
        <form action="{{ route('profile.destroy', $user->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your profile?')">DELETE MY PROFILE</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection