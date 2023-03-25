<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameScore;
use App\Models\GameVersion;
use Illuminate\Http\Request;

class GameController extends Controller
{
    function index() {
        $games = Game::all();
        return view('admin.games.index', ['games'=>$games]);
    }

    function show($slug, $version_id = null) {
        $game = Game::where('slug', $slug)->with('game_author')->firstOrFail();
        $versionsBuilder = GameVersion::where('game_id', $game->id);
        $versions = $versionsBuilder->get();
        if ($version_id) {
            $version = $versionsBuilder->find($version_id);
        } else {
            $version = $versionsBuilder->first();
        }
        
        $scores = GameScore::where('game_version_id', $version->id)->with('player', 'version')->orderByDesc('score')->get();
        return view('admin.games.profile', ['game'=>$game, 'versions'=>$versions, 'scores'=>$scores]);
    }

    public function reset($slug) {
        $game = Game::where('slug', $slug)->firstOrFail();
    
        // Delete all scores
        GameScore::whereHas('version', function ($query) use ($game) {
            $query->where('game_id', $game->id);
        })->delete();
    
        // Redirect back to game profile page
        return redirect()->route('admin.games.profile', ['slug' => $slug]);
    }
    
    public function deletePlayerScore($slug, $score_id) {
        GameScore::where('id', $score_id)->delete();
        return redirect()->route('admin.games.profile', ['slug' => $slug]);
    }

    public function deleteAllPlayerScores($slug, $player_id) {
        $game = Game::where('slug', $slug)->firstOrFail();
        GameScore::whereHas('version', function ($query) use ($game) {
            $query->where('game_id', $game->id);
        })->where('platform_user_id', $player_id)->delete();
        return redirect()->route('admin.games.profile', ['slug' => $slug]);
    }
}