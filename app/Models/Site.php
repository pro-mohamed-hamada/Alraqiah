<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use App\Traits\IsActiveTrait;

class Site extends Model
{
    use HasFactory, Filterable, IsActiveTrait;

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
