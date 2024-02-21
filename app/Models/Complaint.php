<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory, Filterable, IsActiveTrait;

    protected $fillable = [
        'complaint',
        'is_active',
        'client_id',
    ];

    public function replies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ComplaintReplay::class);
    }

}
