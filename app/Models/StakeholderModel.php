<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StakeholderModel extends Model
{
    use HasFactory;

    protected $table = 't_stakeholder';

    protected $primaryKey = 'id_stakeholder';

    protected $fillable = [
        'id_lulusan',
        'nama_atasan',
        'jabatan_atasan',
        'email_atasan',
        'kode_atasan',
        'sudah_mengisi'
    ];

    protected $casts = ['sudah_mengisi' => 'boolean'];

    public function kuisionerstakeholder(): HasOne
    {
        return $this->hasOne(KuisionerStakeholderModel::class, 'id_stakeholder', 'id_stakeholder');
    }

    public function lulusan(): BelongsTo
    {
        return $this->belongsTo(LulusanModel::class, 'id_lulusan', 'id_lulusan');
    }
}
