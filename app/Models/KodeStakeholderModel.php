<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeStakeholderModel extends Model
{
    use HasFactory;

    protected $table = 't_kode_stakeholder';

    protected $primaryKey = 'id_kode_stakeholder';
    
    protected $fillable = ['email', 'kode_atasan'];
}
