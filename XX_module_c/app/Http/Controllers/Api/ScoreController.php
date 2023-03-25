<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameScore;
use App\Models\GameVersion;
use App\Models\Game;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $game_version = GameVersion::where('game_id', $game->id)->first();
        $scores = GameScore::where('game_version_id', $game_version->id)->with('player')->orderByDesc('score')->get();
        return response()->json([
            'scores' => $scores
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $game_version = $game->latestVersion();
        $new_score = new GameScore;
        $new_score->score = $request->input('score');
        $new_score->game_version_id = $game_version->id;
        $new_score->platform_user_id = $request->user()->id;
        $new_score->save();

        return response()->json([
            'status' => 'success',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(GameScore $gameScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GameScore $gameScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GameScore $gameScore)
    {
        //
    }
}