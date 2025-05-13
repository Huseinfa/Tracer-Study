<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfesiModel extends Model
{
    use HasFactory;

    protected $table = 't_profesi';

    protected $primaryKey = 'id_profesi';

    protected $fillable = ['id_kategori_profesi', 'nama_profesi'];

    public function kategoriProfesi(): BelongsTo
    {
        return $this->belongsTo(KategoriProfesiModel::class, 'id_kategori_profesi', 'id_kategori_profesi');
    }
}
