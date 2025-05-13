<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProfesiModel extends Model
{
    use HasFactory;

    protected $table = 't_kategori_profesi';

    protected $primaryKey = 'id_kategori_profesi';

    protected $fillable = ['nama_kategori'];
}
