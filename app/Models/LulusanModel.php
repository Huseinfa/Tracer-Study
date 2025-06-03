<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class LulusanModel extends Model
{
    use HasFactory;

    protected $table = 't_lulusan';
    protected $primaryKey = 'id_lulusan';
    protected $fillable = [
        'id_program_studi',
        'nim',
        'nama_lulusan',
        'email_lulusan',
        'no_hp_lulusan',
        'tahun_lulus',
        'sudah_mengisi',
    ];
    protected $dates = ['tanggal_lulus']; // Added for Carbon date handling

    protected $casts = ['sudah_mengisi' => 'boolean'];

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(ProdiModel::class, 'id_program_studi', 'id_program_studi');
    }

    public function kuisionerlulusan(): HasOne
    {
        return $this->hasOne(KuisionerLulusanModel::class, 'id_lulusan', 'id_lulusan');
    }
    
    public function kuisionerstakeholder(): HasOne
    {
        return $this->hasOne(KuisionerStakeholderModel::class, 'id_lulusan', 'id_lulusan');
    }

    public function stakeholder(): HasOne
    {
        return $this->hasOne(StakeholderModel::class, 'id_lulusan', 'id_lulusan');
    }

    public function getMasaTungguAttribute()
    {
        if ($this->kuisionerlulusan && $this->kuisionerlulusan->tanggal_pertama_berkerja) {
            $tanggalLulus = Carbon::parse($this->tanggal_lulus);
            $tanggalKerja = Carbon::parse($this->kuisionerlulusan->tanggal_pertama_berkerja);
            $waitingTime = $tanggalLulus->diffInMonths($tanggalKerja);
            return $waitingTime . ' bulan';
        }
        return '-';
    }
}