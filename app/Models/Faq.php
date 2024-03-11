<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Faq extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'question',
        'answer',
        'is_active',
    ];

}
