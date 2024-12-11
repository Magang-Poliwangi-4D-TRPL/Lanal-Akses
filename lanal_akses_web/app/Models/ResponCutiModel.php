<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponCutiModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'respon_cuti';

    public function pengajuan_cuti(){
        return $this->belongsTo(PengajuanCutiModel::class, 'pengajuan_cuti_id');
    }

    public function atasan(){
        return $this->belongsTo(PersonilModel::class, 'atasan_id');
    }

    public function palaksa(){
        return $this->belongsTo(PersonilModel::class, 'palaksa_id');
    }

    public function sekretaris(){
        return $this->belongsTo(PersonilModel::class, 'sekretaris_id');
    }

    public function komandan(){
        return $this->belongsTo(PersonilModel::class, 'komandan_id');
    }
}
