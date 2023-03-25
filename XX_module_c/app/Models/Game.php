<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function game_author() {
        return $this->belongsTo(PlatformUser::class, 'author', 'id');
    }

    public function latestVersion()
    {
        return $this->versions()->latest('created_at')->firstOrFail();
    }

    public function versions()
    {
        return $this->hasMany(GameVersion::class);
    }

    public function scores()
    {
        return $this->hasManyThrough(GameScore::class, GameVersion::class);
    }
}