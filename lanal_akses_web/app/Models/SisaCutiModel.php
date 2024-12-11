<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisaCutiModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'sisa_cuti';

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }
}
