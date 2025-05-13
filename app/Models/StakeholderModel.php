<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
