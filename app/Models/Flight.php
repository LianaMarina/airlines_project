<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    public function airplane() {
        return $this->belongsTo(Airplane::class);
    }

    public function tikets() {
        return $this->hasMany(Tiket::class);
    }

    public function cities() {
        return $this->hasMany(City::class);
    }

    public function airports() {
        return $this->hasMany(Airport::class);
    }
}
