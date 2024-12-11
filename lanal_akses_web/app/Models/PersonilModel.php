<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonilModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'personil';

    public function user()
    {
        return $this->hasOne(User::class, 'personil_id');
    }

    public function kehadiran()
    {
        return $this->hasMany(KehadiranModel::class, 'personil_id');
    }
}

