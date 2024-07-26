<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $table = 'receipts'; // Nome della tabella

    protected $fillable = [
        'plan_id',
        'date',
        'flat_id',
        'expire_date',
    ];

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }
}
