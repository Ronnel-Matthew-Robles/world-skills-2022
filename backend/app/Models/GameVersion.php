<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class GameVersion extends Model
{
    use HasFactory, SoftDeletes;

    public function game() {
        return $this->hasOne(Game::class)->withTrashed();
    }

    public function getThumbnailPath() {
        return 'games/'.$this->game_id.'/'.$this->version.'/thumbnail.png';
    }

    public function hasThumbnailPath() {
        return Storage::disk('local')->exists($this->getThumbnailPath());
    }

    public function scores() {
        return $this->hasMany(Score::class)->orderBy('score', 'desc');
    }
}