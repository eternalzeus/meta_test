<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
