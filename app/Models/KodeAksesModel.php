<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KodeAksesModel extends Model
{
    use HasFactory;

    protected $table = 't_kode_akses';

    protected $primaryKey = 'id_kode';

    protected $fillable = ['id_lulusan', 'id_stakeholder', 'kode', 'is_used'];

    public function lulusan(): BelongsTo
    {
        return $this->belongsTo(LulusanModel::class, 'id_lulusan', 'id_lulusan');
    }

    public function stakeholder(): BelongsTo
    {
        return $this->belongsTo(StakeholderModel::class, 'id_stakeholder', 'id_stakeholder');
    }
}
