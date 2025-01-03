<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanCutiModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pengajuan_cuti';

    public function personil()
    {
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }

    public function cuti()
    {
        return $this->belongsTo(CutiModel::class, 'cuti_id');
    }

    public function dataCutiPersonel()
    {
        return $this->hasOne(DataCutiPersonelModel::class, 'pengajuan_cuti_id');
    }

    public function dataCutiPegawai()
    {
        return $this->hasOne(DataCutiPegawaiModel::class, 'pengajuan_cuti_id');
    }

    public function responCuti()
    {
        return $this->hasOne(ResponCutiModel::class, 'pengajuan_cuti_id');
    }
}
