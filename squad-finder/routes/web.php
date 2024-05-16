<?php

use App\Http\Controllers\GroupsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use App\Models\Group;
use App\Models\Platform;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas de usuarios.
Route::get('/profile/{id}', 'App\Http\Controllers\UserController@profile')->name('profile');

Route::delete('/profile/destroy/{id}', 'App\Http\Controllers\UserController@destroy')->name('profile.destroy');

Route::get('/profile/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('profile.edit');
Route::post('/profile/update/{id}', 'App\Http\Controllers\UserController@update')->name('profile.update');

Route::get('/profile/list/all', 'App\Http\Controllers\UserController@list')->name('profile.list');


Route::get('/games', 'App\Http\Controllers\GameController@index')->name('games');
Route::get('/games/search', 'App\Http\Controllers\GameController@search')->name('games.search');
Route::get('/games/filter', 'App\Http\Controllers\GameController@filter')->name('games.filter');



Route::get('about', function () {
    return view('about', ['name' => 'Squad-Finder']);
})->name('about');



Route::get('createGroups', function () {
    $games = Game::all();

    $platformsByGame = [];
    foreach ($games as $game) {
        $platformsByGame[$game->id] = $game->platforms()->get();
    }

    $gamesJson = json_encode($games);
    $platformsByGameJson = json_encode($platformsByGame);

    return view('groups.create', [
        'name' => 'Squad-Finder',
        'games' => $games,
        'gamesJson' => $gamesJson,
        'platformsByGameJson' => $platformsByGameJson
    ]);
})->name('creategroups');


Route::get('/platforms', 'App\Http\Controllers\PlatformController@index')->name('platforms');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile/{id}', 'App\Http\Controllers\UserController@profile')->name('profile');
    Route::delete('/profile/destroy/{id}', 'App\Http\Controllers\UserController@destroy')->name('profile.destroy');
    Route::get('/profile/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('profile.edit');
    Route::post('/profile/update/{id}', 'App\Http\Controllers\UserController@update')->name('profile.update');
    Route::put('/profile/update/{id}', 'App\Http\Controllers\UserController@update')->name('profile.update');
    Route::get('/profile/list/all', 'App\Http\Controllers\UserController@list')->name('profile.list');
    Route::get('/friends', 'App\Http\Controllers\UserController@listFriends')->name('friends.list');
    Route::delete('/friends/destroy/{id}', 'App\Http\Controllers\UserController@destroyFriend')->name('friends.destroy');
    Route::get('/friends/show/{id}', 'App\Http\Controllers\UserController@show')->name('friends.show');
    Route::get('/friends/search', 'App\Http\Controllers\UserController@searchFriends')->name('friends.search');
    Route::get('/friends/add', 'App\Http\Controllers\UserController@addFriends')->name('friends.add');
    Route::post('/friends/add/{id}', 'App\Http\Controllers\UserController@storeFriend')->name('friends.store');
    Route::get('/friends/search/new/', 'App\Http\Controllers\UserController@searchNewFriends')->name('friends.searchNewFriends');

    
});



//------------------------------------ Rutas de groups ------------------------------------
Route::get('/groups', [GroupsController::class, 'index'])->name('ListaGrupos');
Route::get('/listado-grupos', 'App\Http\Controllers\GroupsController@index')->name('ListaGrupos.index');
Route::post('leavegroup/{group}', 'App\Http\Controllers\GroupsController@leaveGroup')->name('leavegroup');
Route::get('/groups/{id}', [GroupsController::class, 'show'])->name('ListaGrupos.show');
Route::delete('groups/{id}', [GroupsController::class, 'destroy'])->name('ListaGrupos.destroy');
Route::get('/groups/create', [GroupsController::class, 'create'])->name('groups.create');
Route::post('/groups', [GroupsController::class, 'store'])->name('groups.store');
Route::post('/groups/{group}/join', [GroupsController::class, 'joinGroup'])->name('groups.join');


Route::get('/games/{id}', 'App\Http\Controllers\GameController@show')->name('games.show');
Route::delete('/games/{id}', 'App\Http\Controllers\GameController@delete')->name('game.delete');
