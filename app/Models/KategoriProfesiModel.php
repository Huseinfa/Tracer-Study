<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriProfesiModel extends Model
{
    use HasFactory;

    protected $table = 't_kategori_profesi';

    protected $primaryKey = 'id_kategori_profesi';

    protected $fillable = ['nama_kategori'];

    public function kuisionerlulusan(): HasMany
    {
        return $this->hasMany(KuisionerLulusanModel::class, 'id_kategori_profesi', 'id_kategori_profesi');
    }

    public function profesi(): HasMany
    {
        return $this->hasMany(ProfesiModel::class, 'id_kategori_profesi', 'id_kategori_profesi');
    }
}
