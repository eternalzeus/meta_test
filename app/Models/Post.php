<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Http\Helpers\CustomPaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model    // map to posts table
{
    use HasFactory;

    protected $fillable = ['title','body','image','user_id'];

    public function user()
    { 
        return $this->belongsTo(User::class,'user_id'); // Relationship between User_id at the Post table to the name of that User_id
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }

    public static function fullPostArray($request)
    {
        $posts = DB::table('posts');
        if(!empty($request->title)){
            $posts = $posts->where('title',"LIKE",'%'.$request->title.'%');
        }
        if(!empty($request->body)){
            $posts = $posts->where('body',"LIKE",'%'.$request->body.'%');
        }
        $posts = $posts->get();
        $r = [];
        foreach($posts as $post){
            $r[] = [
                'post_id' => $post->id,
                'title' => $post->title,
                'content' => $post->body,
                'comment' => self::getCommentByPost($post->id),
            ];
        }
        $res = self::paginate($r)->appends($request->all());
        
        return $res;
    }

    private static function paginate($items, $perPage = 3, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new CustomPaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    private static function getUserNameByComment($userId)
    {
        $user = User::find($userId);
        if ($user){
            return $user->name;
        }

        return null;
    }
    private static function getCommentByPost($postId)
    {
        $comments = Comment::where('post_id', $postId)->get();
        // ->pluck('comment')->toArray();
        $res = [] ;
        foreach ($comments as $comment){
            $res[] = [
            'comment_content' =>  self::getUserNameByComment($comment->user_id) . ': ' . $comment->comment ,
            'comment_image' => self::getImagesByComment($comment->id),
            ];
        }

        return $res;
    }

    private static function getImagesByComment($commentId)
    {
        $comment = Comment::find($commentId);
        $images = $comment -> images;
        $res = [];  
        foreach ($images as $image){
            $res [] = $image->path;
        }
        
        return $res;
    }
    
}
