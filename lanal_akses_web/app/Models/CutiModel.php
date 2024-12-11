<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutiModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'cuti';

    public function data_cuti_personel(){
        return $this->hasMany(DataCutiPersonelModel::class, 'cuti_id');
    }

    public function pengajuan_cuti(){
        return $this->hasMany(PengajuanCutiModel::class, 'cuti_id');
    }
}
