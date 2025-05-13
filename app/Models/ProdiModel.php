<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdiModel extends Model
{
    use HasFactory;

    protected $table = 't_program_studi';

    protected $primaryKey = 'id_program_studi';

    protected $fillable = ['nama_prodi'];
}
