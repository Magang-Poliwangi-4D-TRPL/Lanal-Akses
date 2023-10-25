<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerlengkapanModel extends Model
{
    use HasFactory;
    protected $table = 'perlengkapan';
    protected $guarded = ['id'];

    public function personil(){
        return $this->belongsTo(PersonilModel::class, 'personil_id');
    }
}
