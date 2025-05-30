<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeLulusanModel extends Model
{
    use HasFactory;

    protected $table = 't_kode_lulusan';

    protected $primaryKey = 'id_kode_lulusan';

    protected $fillable = ['email', 'kode_lulusan', 'is_used'];
}
