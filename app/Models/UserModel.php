<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 't_user';

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'nama_user',
        'password',
    ];
}
