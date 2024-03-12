<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Site extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'title',
        'url',
        'is_active',
    ];

    public function clients(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Client::class,  ClientSite::class)->withTimestamps();
    }

}
