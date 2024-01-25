<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaJasaModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'tanda_jasa';

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }
}
