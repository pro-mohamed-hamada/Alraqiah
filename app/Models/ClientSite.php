<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientSite extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'site_id'];
}
