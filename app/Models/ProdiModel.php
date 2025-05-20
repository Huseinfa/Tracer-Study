<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProdiModel extends Model
{
    use HasFactory;

    protected $table = 't_program_studi';

    protected $primaryKey = 'id_program_studi';

    protected $fillable = ['nama_prodi'];

    public function lulusan(): HasMany
    {
        return $this->hasMany(LulusanModel::class, 'id_program_studi', 'id_program_studi');
    }
}
