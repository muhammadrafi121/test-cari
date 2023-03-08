<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function city() {
        return $this->belongsTo(City::class, 'city', 'shapename');
    }

    public function province() {
        return $this->belongsTo(Province::class, 'province', 'shapename');
    }
}
