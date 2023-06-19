<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['country_id', 'city_id', 'district_id', 'user_address', 'user_id'];
    use HasFactory;
}
