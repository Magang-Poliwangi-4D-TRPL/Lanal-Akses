<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiAnakModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'informasi_anak';

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }
}
