<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['city_name', 'country_id'];
    use HasFactory;
    const STASUS = 'status';
    public static function commonCheck($data, $value, )
    {
        if($data[$value] -> isEmpty()){
            $data[STASUS] = 400;
        }
        else $data[STASUS] = 200;
        return $data;
    }
}
