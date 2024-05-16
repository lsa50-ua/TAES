@extends('layouts.master')

@section('title', 'Detalles Grupo')

@section('content')

<div class="container mt-5">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="card">
        <div class="card-header bg-dark text-white">
          <h3 class="card-title">{{ $group->name }}</h3>
        </div>
        <div class="card-body">
        <div class="d-flex justify-content-between">
        <h4 class="card-title medium"> {{ $game->name }}</h4>
        <h4 class="card-title medium text-end">{{ $group->language }}</h4>
        <h4 class="card-title medium text-end">Platform: {{ $group->platforms->name ?? 'Unknown' }}</h4>
        <h4 class="card-title medium text-end">Crossplay: {{ $group->crossplay ? 'yes' : 'no' }}</h4>
</div>

          <hr>
          <h5 class="card-title">Group members {{ $group->users_count }} / {{ $group->nMaxUsers }}</h5>
          <ul class="list-group">
            @foreach($users as $user)
            <li class="list-group-item">{{ $user->name }}</li>
            @endforeach
          </ul>
          <hr>
          <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('ListaGrupos') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            <form action="{{ route('groups.join', $group) }}" method="POST">
              @csrf
              @guest
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#avisoModal">Join group</button>
              @else
                @if($group->users_count == $group->nMaxUsers)
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#avisoModal2">Join group</button>
                @else
                  @if($group->users()->where('users.id', auth()->user()->id)->exists())
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#avisoModal3">Join group</button>
                  @else
                    <button type="submit" class="btn btn-success">Unirse al grupo</button>
                  @endif
                @endif
              @endguest
            </form>
            @if(auth()->check() && $group->users()->where('user_id', auth()->user()->id)->exists())
                <form action="{{ route('leavegroup', $group->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Leave Group</button>
                </form>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Ventana modal de aviso debe iniciar sesion-->
<div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="avisoModalLabel">Aviso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Primero debes iniciar sesión para unirte al grupo.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Ventana modal de aviso grupo completo -->
<div class="modal fade" id="avisoModal2" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="avisoModalLabel">Aviso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>No te puedes unir, ya que este grupo se encuentra completo actualmente</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Ventana modal de aviso ya perteneces a este grupo -->
<div class="modal fade" id="avisoModal3" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="avisoModalLabel">Aviso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>No te puedes unir a este grupo, ya que ya perteneces a este</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

@endsection




