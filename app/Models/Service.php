<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'icon'];

    public function flats()
    {
        return $this->belongsToMany(Flat::class);
    }
}
