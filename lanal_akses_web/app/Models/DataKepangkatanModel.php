<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKepangkatanModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'data_kepangkatan';

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }
}
