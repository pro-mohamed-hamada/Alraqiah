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
        'identity_number',
        'seat_number',
        'country',
        'city',
        'client_id',
        'chronic_disease',
        'chronic_disease_discription',
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
