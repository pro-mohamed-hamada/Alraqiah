<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Relative extends Model
{
    use HasFactory, Filterable;
    
    protected $fillable = [
        'name',
        'gender',
        'national_number',
        'seat_number',
        'city',
        'client_id'
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
