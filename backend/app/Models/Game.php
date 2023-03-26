<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = ['id', 'created_by', 'created_at', 'updated_at', 'deleted_at'];
    // protected $append = ['thumbnail', 'uploadTimestamp', 'author', 'scoreCount', 'gamePath'];
    protected $date = ['uploadTimestamp'];

    public function gameAuthor() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function latestVersion() {
        return $this->hasOne(GameVersion::class)->whereNull('deleted_at');
    }

    public function versions() {
        return $this->hasMany(GameVersion::class)->withTrashed();
    }
}