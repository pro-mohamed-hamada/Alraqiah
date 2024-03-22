<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use App\Traits\IsActiveTrait;

class Faq extends Model
{
    use HasFactory, Filterable, IsActiveTrait;

    protected $fillable = [
        'question',
        'answer',
        'is_active',
    ];

}
