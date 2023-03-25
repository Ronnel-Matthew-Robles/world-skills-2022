<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameScore extends Model
{
    protected $fillable = ['score'];

    public function player()
    {
        return $this->belongsTo(PlatformUser::class, 'platform_user_id', 'id');
    }

    public function version()
    {
        return $this->belongsTo(GameVersion::class, 'game_version_id', 'id');
    }
}