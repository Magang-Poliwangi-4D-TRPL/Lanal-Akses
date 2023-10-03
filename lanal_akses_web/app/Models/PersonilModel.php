<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonilModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'personil';

    public function pendidikanFormal()
    {
        return $this->hasMany(PendidikanFormalModel::class);
    }
}

