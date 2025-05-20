<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 't_user';
    protected $primaryKey = 'id_user';
    protected $fillable = ['username', 'nama_user', 'password'];
    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function username()
    {
        return 'username';
    }

    public function getAuthIdentifier()
    {
        return $this->id_user;
    }
}