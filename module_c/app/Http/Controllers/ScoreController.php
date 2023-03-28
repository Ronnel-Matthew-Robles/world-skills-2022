<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Game;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score, Request $request)
    {
        
    }

    public function destroyGame(Game $game) {

    }
}