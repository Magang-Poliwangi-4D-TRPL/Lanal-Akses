<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiOrangTuaModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'informasi_orang_tua';

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }
}
