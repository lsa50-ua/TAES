<!-- resources/views/groups/index.blade.php -->

@extends('layouts.master')

@section('title', 'Listado grupos')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('ListaGrupos.index') }}" method="get">
                <div class="form-group">
                    <label for="game_id">Filter by game</label>
                    <select name="game_id" id="game_id" class="form-control">
                        <option value="">-- Select a game --</option>
                        @foreach ($games as $game)
                            <option value="{{ $game->id }}"
                                {{ $game->id == $selectedGame ? 'selected' : '' }}>
                                {{ $game->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="language">Filter by language</label>
                    <select name="language" id="language" class="form-control">
                        <option value="">-- Select a language --</option>
                        @foreach ($languages as $language)
                            <option value="{{ $language }}"
                                {{ $language == $selectedLanguage ? 'selected' : '' }}>
                                {{ $language }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="platform">Filter by platform</label>
                    <select name="platform" id="platform" class="form-control">
                        <option value="">-- Select a platform --</option>
                        @foreach ($platforms as $platform)
                            <option value="{{ $platform->id }}"
                                {{ $platform->id == $selectedPlatform ? 'selected' : '' }}>
                                {{ $platform->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

  
                <div class="form-group">
                    <label for="search">Search by name</label>
                    <input type="text" name="search" id="search" class="form-control" value="{{ $search }}">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Filter</button>
            </form>
        </div>
    </div>
    <br>
    <div>
        @guest
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#avisoModal">Create Group</button>

        @else 
            <a href="{{ route('creategroups') }}" class="btn btn-primary">Create Group</a>
        @endguest
    </div>

    <table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Players</th>
            <th>Language</th>
            <th>Crossplay</th>
            <th></th> <!-- Celda vacía para el botón "Ver más" -->
        </tr>
    </thead>
    <tbody>
    @forelse ($groups as $group)
    <tr>
        <td>{{ $group->name }}</td>
        <td>{{ $group->users_count }} / {{ $group->nMaxUsers }}</td>
        <td>{{ $group->language }}</td>
        <td>
                    @if($group->crossplay)
                        <i class="fa fa-check text-success"></i>
                    @else
                        <i class="fa fa-times text-danger"></i>
                    @endif
                </td>
        <td>
            <a href="{{ route('ListaGrupos.show', $group->id) }}" class="btn btn-primary btn-sm">
                See more
            </a>
            @if(auth()->check() && auth()->user()->isAdmin)
                <form action="{{ route('ListaGrupos.destroy', $group->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            @elseif(auth()->check() && $group->users()->where('user_id', auth()->user()->id)->exists())
                <form action="{{ route('leavegroup', $group->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-sm">Leave Group</button>
                </form>
            @endif
        @empty
            <tr>
                <td colspan="4" class="text-center">No se encontraron grupos.</td>
            </tr>
        @endforelse
    </tbody>
</table>


<!-- Ventana modal de aviso debe iniciar sesion-->
<div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="avisoModalLabel">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>You have to be an user to be able to create a group.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection
