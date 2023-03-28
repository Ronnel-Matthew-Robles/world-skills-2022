<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('game.index', ['games' => Game::withTrashed()->get()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return view('game.detail', ['game' => $game]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->back();
    }
}