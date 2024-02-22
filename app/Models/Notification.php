<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'read_at',
    ];

}
