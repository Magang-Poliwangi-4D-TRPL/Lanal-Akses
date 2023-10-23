<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggunganKeluargaModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'tanggungan_keluarga';

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }
}
