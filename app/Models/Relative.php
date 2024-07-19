<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Relative extends Model implements HasMedia
{
    use HasFactory, Filterable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'gender',
        'identity_number',
        'seat_number',
        'country',
        'city',
        'client_id',
        'chronic_disease',
        'chronic_disease_description',
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
