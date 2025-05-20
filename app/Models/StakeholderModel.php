<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StakeholderModel extends Model
{
    use HasFactory;

    protected $table = 't_stakeholder';

    protected $primaryKey = 'id_stakeholder';

    protected $fillable = [
        'nama_atasan',
        'instansi',
        'jabatan',
        'email',
    ];

    public function kuisionerstakeholder(): HasOne
    {
        return $this->hasOne(KuisionerStakeholderModel::class, 'id_stakeholder', 'id_stakeholder');
    }

    public function kodeakses(): HasOne
    {
        return $this->hasOne(KodeAksesModel::class, 'id_stakeholder', 'id_stakeholder');
    }
}
