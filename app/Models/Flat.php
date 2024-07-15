<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Flat extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'slug' , 'rooms', 'bathrooms' , 'beds' , 'square_meters' , 'address', 'image_path' ,'visible'];

    public function views () {
        return $this->hasMany(View::class);
    }
    public function messages () {
        return $this->hasMany(Message::class);
    }
    public function services () {
        return $this->belongsToMany(Service::class);
    }
    public function plans () {
        return $this->belongsToMany(Plan::class, 'receipts');
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

}
