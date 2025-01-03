<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCutiPersonelModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'data_cuti_personel';

    public function pengajuan_cuti(){
        return $this->belongsTo(PengajuanCutiModel::class, 'pengajuan_cuti_id');
    }

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }

    public function cuti(){
        return $this->hasOne(CutiModel::class, 'cuti_id');
    }
}
