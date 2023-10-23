<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'kursus';

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }
}
