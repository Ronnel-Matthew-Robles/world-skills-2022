<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    
    protected $table = 'admin_users';

    protected $fillable = ['username', 'password'];
}