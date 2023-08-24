<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $fillable = ['product_name','cost','image','description','user_id'];

    use HasFactory;
    
    public function user()
    { 
        return $this->belongsTo(User::class,'user_id'); // Relationship between User_id at the Post table to the name of that User_id
    }

    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }

    public function categories()
    {
        return $this->belongstoMany(Category::class);
    }
}
