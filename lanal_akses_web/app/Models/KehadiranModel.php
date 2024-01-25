<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KehadiranModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'kehadiran';

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    } 
    public function pegawai(){
        return $this->belongsTo(pegawaiModel::class, 'pegawai_id');
    } 
    public function waktu_kerja(){
        return $this->belongsTo(WaktuKerjaModel::class, 'waktu_kerja_id');
    } 
}
