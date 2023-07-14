<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['country_id', 'city_id', 'district_id', 'user_address', 'user_id'];
    use HasFactory;
    const STASUS = 'status';
    public static function checkAjax($data, $value){
        if($data[$value] -> isEmpty()){
            $data[self::STATUS] = 400;
        }
        else $data['status'] = 200;
        return $data;
    }
    public static function validate($data, $value){
        if($data[$value] -> isEmpty()){
            $data['status'] = 400;
        }
        else $data['status'] = 200;
        return $data;
    }
}
