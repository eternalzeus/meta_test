<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function imageable(){
        return $this->morphTo();
    }
    
    public static function createImage($data){
        $image = self::common($data);
        return $image;
    }
    public static function updateImage($data,$id){
        $image = self::common($data, $id);
        return $image;
    }

    public static function common($data, $id = null) {
        if ($id) {
            $image = Image::find($id);
            Storage::disk('public')->delete($image->name);
        } else {
            $image = new Image;
        }
        $image_code = md5(rand(100,1000));      
        $ext = strtolower($data -> getClientOriginalExtension()); // Lấy đuôi cuối của file .png
        $image_name = $data -> getClientOriginalName();
        $image_full_code = $image_code.'.'.$ext;
        Storage::disk('public')->put( $image_full_code, file_get_contents($data) );
        $image->path = Storage::url($image_full_code);
        $image->code = $image_full_code;
        $image->name = $image_name;
        return $image;
    }
}
