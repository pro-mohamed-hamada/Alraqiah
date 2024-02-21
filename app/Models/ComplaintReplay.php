<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintReplay extends Model
{
    use HasFactory;

    protected $fillable = [
        'replay',
        'complaint_id',
    ];

    public function complaint(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Complaint::class);
    }

}
