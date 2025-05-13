<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KuisionerStakeholderModel extends Model
{
    use HasFactory;

    protected $table = 't_kuisioner_stakeholder';

    protected $primaryKey = 'id_kuisioner_stakeholder';

    protected $fillable = [
        'id_lulusan',
        'id_stakeholder',
        'kerjasama_tim',
        'keahlian_it',
        'kemampuan_bahasa_asing',
        'kemampuan_komunikasi',
        'pengembangan_diri',
        'kepemimpinan',
        'etos_kerja',
        'kompetensi_yang_belum_dipenuhi',
        'saran_kurikulum_prodi'
    ];

    public function lulusan(): BelongsTo
    {
        return $this->belongsTo(LulusanModel::class, 'id_lulusan', 'id_lulusan');
    }
    
    public function stakeholder(): BelongsTo
    {
        return $this->belongsTo(StakeholderModel::class, 'id_stakeholder', 'id_stakeholder');
    }
}
