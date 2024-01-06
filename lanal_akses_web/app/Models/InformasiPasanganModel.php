<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPasanganModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'informasi_pasangan';

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }
}
