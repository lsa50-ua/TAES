@auth
    @extends('layouts.master')
    @section('title', 'Home')
    @section('content')
    <div class="container" style="padding-left: 20%; padding-right: 20%; ">
        <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel" style="box-shadow: 0px 0px 10px grey; ">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/img_juegos/img_juego_fall_guys.jpg" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="/images/img_juegos/star_wars.jpeg" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="images/img_juegos/valorant.jpg" class="d-block w-100">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="content-fluid " style="margin-top: 2%; margin-bottom: 2%;">
        <h1>Groups</h1>
        @if ($user->groups->isEmpty())
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="info-fill" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
            </svg>  

            <div class="alert alert-primary d-flex align-items-center" role="alert" style="margin-top: 2%;">
                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:"><use xlink:href="#info-fill"></use></svg>
                <div>
                    You are not in any group. Go look for a <a href="{{ route('ListaGrupos') }}" class="alert-link">Group</a>.
                </div>
            </div>
        @else
            @if($user->groups->count() > 3)
            <div class="row row-cols-3" style="margin-top: 2%;">
                @foreach($user->groups->slice(0, 3) as $group)
                    <div class="col-4" style="margin-bottom: 2%;">
                        <div class="card" >
                            <img src="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $group->name }}</h5>
                                <p class="card-text">{{ $group->language }}</p>
                                <a href="{{ route('ListaGrupos.show', $group->id) }}" class="btn btn-primary">Info</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="container d-flex justify-content-center">
                    <button onclick="window.location='{{ route('ListaGrupos') }}'" type="button" class="btn btn-outline-success">See More</button>
                </div>
            </div>
            @else
            <div class="row row-cols-3" style="margin-top: 2%;">
                @foreach($user->groups as $group)
                    <div class="col-4" style="margin-bottom: 2%;">
                        <div class="card" >
                            <img src="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $group->name }}</h5>
                                <p class="card-text">{{ $group->language }}</p>
                                <a href="{{ route('ListaGrupos.show', $group->id) }}" class="btn btn-primary">Info</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        @endif
    </div>
    <div class="content-fluid " style="margin-top: 2%; margin-bottom: 2%;">
        <h1>Friends</h1>
        @if ($friends->isEmpty())
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="info-fill" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
            </svg>  

            <div class="alert alert-primary d-flex align-items-center" role="alert" style="margin-top: 2%;">
                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:"><use xlink:href="#info-fill"></use></svg>
                <div>
                    You don't have any added friends.
                </div>
            </div>
        @else
            @if($friends->count() > 3)
            <div class="row row-cols-3" style="margin-top: 5%;">
                @foreach($friends->slice(0, 3) as $friend)
                    <div class="col-4 d-flex justify-content-center" style="margin-bottom: 1%;">
                    <a href="#" style="text-decoration: none;">
                        <div class="card border-light mb-3" style="max-width: 18rem; background-color: transparent;  border: 0;">
                        @if($friend->image == NULL)
                        <img src="/images/default_avatar.jpg" class="rounded-circle" style="border-radius:50%; width: 13rem; border: 1px solid #566573;">
                        @else
                        <img src="{{ asset('storage/images/' . $friend->id . '.jpg') }}" class="rounded-circle img-fluid" style="border-radius:50%; width: 13rem; border: 1px solid #566573; object-fit: cover; aspect-ratio: 1 / 1;">
                        @endif
                            <div class="card-body d-flex justify-content-center">
                                <h5 class="card-title">{{ $friend->name }}</h5>
                            </div>
                        </div>
                    </a>
                    </div>
                @endforeach
                <div class="container d-flex justify-content-center">
                    <button onclick="window.location='{{ route('friends.list') }}'" type="button" class="btn btn-outline-success">See More</button>
                </div>
            </div>
            @else
            <div class="row row-cols-3" style="margin-top: 5%;">
                @foreach($friends as $friend)
                    <div class="col-4 d-flex justify-content-center" style="margin-bottom: 1%;">
                    <a href="{{ route('friends.show', $friend->id) }}" style="text-decoration: none;">
                        <div class="card border-light mb-3" style="max-width: 18rem; background-color: transparent;  border: 0;">
                        @if($friend->image == NULL)
                        <img src="/images/default_avatar.jpg" class="rounded-circle" style="border-radius:50%; width: 13rem; border: 1px solid #566573;">
                        @else
                        <img src="{{ asset('storage/images/' . $friend->id . '.jpg') }}" class="rounded-circle img-fluid" style="border-radius:50%; width: 13rem; border: 1px solid #566573; object-fit: cover; aspect-ratio: 1 / 1;">
                        @endif
                            <div class="card-body d-flex justify-content-center">
                                <h5 class="card-title">{{ $friend->name }}</h5>
                            </div>
                        </div>
                    </a>
                    </div>
                @endforeach
            </div>
            @endif
        @endif
    </div>
    @endsection
@endauth
@guest
<!doctype html>
 <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    </head>

   <body style="background: url('/images/humo-gif2.gif'); background-size: cover;  height: 100vh; width: 100%;">
        <img src="images/logo/logo-sin-fondo.png" class="rounded mx-auto d-block position-absolute top-50 start-50 translate-middle" style="width:25%; padding-left: 1%; filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.5)); max-width:100%;">
   </body>
 </html>    
 @endguest