<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanFormalModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pendidikan_formal';

    public function personil(){
        return $this->belongsTo(PersonilModel::class);
    }
}
