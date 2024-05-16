@extends('layouts.master')

@section('content')
<div class="container">
  <h1>Create Group</h1>

  <form method="POST" action="{{ route('groups.store') }}">
    @csrf
    
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
      <label for="language">Language</label>
      <select class="form-control" id="language" name="language" required> 
        <option value="Spanish">Spanish</option>
        <option value="English">English</option>
        <option value="French">French</option>
        <option value="German">German</option>
        <option value="Chinese">Chinese</option>
        <option value="Japanese">Japanese</option>
      </select>
    </div>

    <div class="form-group">
      <label for="game_id">Game</label>
      <select class="form-control" id="game_id" name="game_id" required>
        <option value="">-- Select a game --</option>
        @foreach($games as $game)
          <option value="{{ $game->id }}">{{ $game->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="platform_id">Platform</label>
      <select class="form-control" id="platform_id" name="platform_id" required>
        <!-- Las opciones de plataforma se generarán dinámicamente mediante JavaScript -->
      </select>
    </div>

    <div class="form-group">
      <label for="crossplay">Crossplay</label>
      <select class="form-control" id="crossplay" name="crossplay" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
    </div>

    <div class="form-group">
      <label for="nMaxUsers">Max Users</label>
      <select class="form-control" id="nMaxUsers" name="nMaxUsers" required>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Create Group</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    var games = JSON.parse('{!! $gamesJson !!}');
    var platformsByGame = JSON.parse('{!! $platformsByGameJson !!}');

    // Obtener los elementos del formulario
    var $gameSelect = $('#game_id');
    var $platformSelect = $('#platform_id');

    // Actualizar las opciones de plataforma cuando se seleccione un juego
    $gameSelect.on('change', function() {
      var selectedGameId = $(this).val();
      var selectedGamePlatforms = platformsByGame[selectedGameId];

      // Limpiar el select de plataforma
      $platformSelect.empty();

      // Agregar las opciones de plataforma según el juego seleccionado
      $.each(selectedGamePlatforms, function(index, platform) {
        $platformSelect.append($('<option>').val(platform.id).text(platform.name));
      });
    });
  });
</script>

@endsection
