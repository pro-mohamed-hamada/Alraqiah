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
        'point_one_lat',
        'point_one_lng',
        'point_two_lat',
        'point_two_lng',
        'point_three_lat',
        'point_three_lng',
        'point_four_lat',
        'point_four_lng',
    ];
}
