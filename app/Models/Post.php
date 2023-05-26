<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model    // map to posts table
{
    use HasFactory;

    protected $fillable = ['title','body','image','user_id'];

    public function user(){ 
        return $this->belongsTo(User::class,'user_id'); // Relationship between User_id at the Post table to the name of that User_id
    }
    public function comments(){
        return $this->hasMany(Comment::class,'post_id');
    }
    public function images(){
        return $this->hasMany(Image::class,'post_id');
    }
}
