<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Platform;
use Illuminate\Http\Request;


class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::All();
        return view ('games.games', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function search(Request $request){
        $searchTerm = $request->input('search');
        $games = Game::query();
        if ($request) {
            $games->where('name', 'LIKE', '%'.$searchTerm. '%');
        }

        $games = $games->get();

        return view('games.games', compact('games'));
    }

    public function orderBy(Request $request){
        $order_by = $request->input('order_by');
    
        if($order_by == "new"){
            $garments = Garment::orderBy('id', 'desc');
        }else{
            $garments = Garment::orderBy($order_by);
        }
        
        $platforms = Platform::all();

        return view('games.games', compact('games', 'platforms'));
    }

    public function filter(Request $request)
    {
        $games = Game::query();
        
        $order_by = $request->input('order_by');

        if($order_by == "new"){
            $games = $games->orderBy('id', 'desc');
        }else if ($order_by != NULL){
            $games = $games->orderBy($order_by);
        }

        $games = $games->get(); 
        $platforms = Platform::all();

        return view('games.games', compact('games', 'platforms'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::findOrFail($id);
        return view('games.showGame', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }

    public function delete($id)
    {
        $game = Game::find($id);
        
        if ($game) {
            // Eliminar el juego
            $game->delete();
            
            // Redirigir a la página de inicio o a otra página
            return redirect()->route('games')->with('success', 'El juego se ha eliminado correctamente.');
        } else {
            // Redirigir a la página de inicio o a otra página con un mensaje de error
            return redirect()->route('home')->with('error', 'El juego que intentas eliminar no existe.');
        }
    }
}
