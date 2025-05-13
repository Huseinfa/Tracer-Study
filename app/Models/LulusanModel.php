<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LulusanModel extends Model
{
    use HasFactory;

    protected $table = 't_lulusan';

    protected $primaryKey = 'id_lulusan';

    protected $fillable = [
        'id_program_studi',
        'nim',
        'nama_lulusan',
        'email',
        'nomor_hp',
        'tanggal_lulus',
        'foto_profil',
    ];

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(ProdiModel::class, 'id_prodi', 'id_prodi');
    }
}
