<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'primary_phone',
        'whatsapp_phone',
        'email',
        'about_us',
        'terms_and_conditions',
        'rate',
        'elhamla_male_doctor_number',
        'elhamla_female_doctor_number',
        'mufti_number',
    ];
}
