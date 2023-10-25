<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenugasanModel extends Model
{
    use HasFactory;
    protected $table = 'riwayat_penugasan';
    protected $guarded = ['id'];

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }
}
