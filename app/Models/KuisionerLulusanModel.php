<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KuisionerLulusanModel extends Model
{
    use HasFactory;

    protected $table = 't_kuisioner_lulusan';

    protected $primaryKey = 'id_kuisioner_lulusan';

    protected $fillable = [
        'id_lulusan',
        'id_kategori_profesi',
        'id_profesi',
        'id_jenis_instansi',
        'tanggal_pertama_berkerja',
        'tanggal_berkerja_instansi_sekarang',
        'jenis_instansi',
        'skala_instansi',
        'nama_instansi',
        'lokasi_instansi',
        'nama_atasan',
        'jabatan_atasan',
        'email_atasan',
        'bersedia_mengisi'
    ];

    protected $casts = ['bersedia_mengisi' => 'boolean'];

    public function lulusan(): BelongsTo
    {
        return $this->belongsTo(LulusanModel::class, 'id_lulusan', 'id_lulusan');
    }

    public function kategoriProfesi(): BelongsTo
    {
        return $this->belongsTo(KategoriProfesiModel::class, 'id_kategori_profesi', 'id_kategori_profesi');
    }

    public function profesi(): BelongsTo
    {
        return $this->belongsTo(ProfesiModel::class, 'id_profesi', 'id_profesi');
    }

    public function jenisInstansi(): BelongsTo
    {
        return $this->belongsTo(JenisInstansiModel::class, 'id_jenis_instansi', 'id_jenis_instansi');
    }
}
