<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Group;
use App\Models\User;
use App\Models\Game;
use App\Models\Platform;




class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $query = Group::query();

    // Filtro por juego
    if ($request->filled('game_id')) {
        $query->where('game_id', $request->game_id);
    }

    // Filtro por idioma
    if ($request->filled('language')) {
        $query->where('language', $request->language);
    }

    if ($request->filled('platform')) {
        $platform = $request->platform;
        $query->where(function ($query) use ($platform) {
            $query->where(function ($query) use ($platform) {
                $query->where('platform_id', $platform);
            })->orWhere(function ($query) use ($platform) {
                $query->where('crossplay', true)
                    ->whereHas('game.platforms', function ($query) use ($platform) {
                        $query->where('platforms.id', $platform);
                    });
            });
        });
    }


    // Búsqueda por nombre
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('name', 'like', "%$search%");
    }

    $groups = $query->withCount('users')->get();

    $games = Game::all();
    $languages = Group::select('language')->distinct()->orderBy('language')->pluck('language');
    $platforms = Platform::all(); // Agrega esto para obtener las plataformas


    return view('groups.index', [
        'groups' => $groups,
        'games' => $games,
        'languages' => $languages,
        'platforms' => $platforms, // Agrega esto para pasar las plataformas a la vista
        'selectedGame' => $request->game_id,
        'selectedLanguage' => $request->language,
        'selectedPlatform' => $request->platform, // Agrega esto para mantener el valor seleccionado en la vista
        'search' => $request->search,
    ]);
}


    public function create() {
        return view('groups.create');
    }

    
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'language' => 'required|max:255',
            'game_id' => 'required|Integer',
            'nMaxUsers' => 'required|Integer',
        ]);
    
        $group = new Group();
        $group->name = $request->input('name');
        $group->language = $request->input('language');
        $group->game_id = $request->input('game_id');
        $group->nMaxUsers = $request->input('nMaxUsers');
        $group->platform_id = $request->platform_id;
        $group->crossplay = $request->crossplay == '1' ? true : false;
        $group->save();
        $user = Auth::user();
        $group->users()->attach($user);
    
        return redirect()->route('home');
    }

    public function leaveGroup(Group $group)
    {
        $user = auth()->user();
        
        if ($group->users()->where('user_id', $user->id)->exists()) {
            $group->users()->detach($user->id);
            
            if ($group->users()->count() === 0) {
                $this->destroy($group->id);
            }
            
            return redirect()->route('ListaGrupos.index')->with('success', 'Has abandonado el grupo exitosamente.');
        }
        
        return redirect()->route('ListaGrupos.index')->with('error', 'No estás unido a este grupo.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::findOrFail($id);
        $game = Game::findOrFail($group->game_id);
        $users = $group->users;
    
        return view('groups.show', [
            'group' => $group,
            'game' => $game,
            'users' => $users
        ]);
    }

    public function joinGroup(Group $group)
    {
        /** @var \App\Models\User $usuario */
        $usuario = auth()->user();
        $usuario->groups()->attach($group);

        return redirect()->back()->with('success', 'Te has unido al grupo correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        if (auth()->check()) {
            $group = Group::findOrFail($id);
            $group->delete();
            return redirect()->route('ListaGrupos.index')->with('success', 'Successful deletion.');
        }
    }
    
}
