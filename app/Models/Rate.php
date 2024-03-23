<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use App\Traits\IsActiveTrait;

class Rate extends Model
{
    use HasFactory, Filterable, IsActiveTrait;

    protected $fillable = [
        'client_id',
        'rate_number',
        'comment',
        'is_active'
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
