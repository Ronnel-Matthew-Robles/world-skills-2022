<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    public function gameVersion() {
        return $this->belongsTo(GameVersion::class)->withTrashed();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}