<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class PlatformUser extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use HasApiTokens;

    public function games() {
        return $this->hasMany(Game::class);
    }
}