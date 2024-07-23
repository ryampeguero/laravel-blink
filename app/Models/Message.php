<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['id', 'flat_id' , 'email', 'message'];

    use HasFactory;
    public function flat () {
        return $this->belongsTo(Flat::class);
    }
}
