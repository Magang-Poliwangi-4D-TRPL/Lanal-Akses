<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanksiHukumanModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'sanksi_hukuman';

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }
}
