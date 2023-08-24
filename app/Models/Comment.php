<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id','user_id','comment'];
    use HasFactory;
    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }
}
