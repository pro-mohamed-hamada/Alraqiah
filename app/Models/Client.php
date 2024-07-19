<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Client extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'reservation_number',
        'package',
        'launch_date',
        'seat_number',
        'gender',
        'identity_number',
        'country',
        'city',
        'parent_id',
        'supervisor_id',
        'chronic_disease',
        'chronic_disease_description',
        'arrival_location_url',
    ];


    public function parent(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function supervisor(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscribers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Client::class,  'parent_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class);
    }
    public function rates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Rate::class,  'client_id');
    }

    public function relatives(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Relative::class,  'client_id');
    }

    public function sites(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Site::class,  ClientSite::class)->withTimestamps();
    }

}
