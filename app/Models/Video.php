<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Video extends Model implements HasMedia
{
    use HasFactory, Filterable, InteractsWithMedia, IsActiveTrait;

    protected $fillable = [
        'title',
        'is_active',
    ];

}
