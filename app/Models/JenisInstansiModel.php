<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisInstansiModel extends Model
{
    use HasFactory;

    protected $table = 't_jenis_instansi';

    protected $primaryKey = 'id_jenis_instansi';

    protected $fillable = ['nama_jenis_instansi'];

    public function kuisionerlulusan(): HasMany
    {
        return $this->hasMany(KuisionerLulusanModel::class, 'id_jenis_instansi', 'id_jenis_instansi');
    }
}
