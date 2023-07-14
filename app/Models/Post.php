<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Support\Facades\DB;
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
        return $this->morphMany(Image::class,'imageable');
    }
    public static function searchAjax($query){
        $output = '';
        $data = DB::table('posts')
                ->where('title', 'like', '%'.$query.'%')
                ->orderBy('id', 'desc')
                ->get();
            $total_row = $data->count();
            if($total_row > 0){
                foreach($data as $index => $row){
                    $output .= '
                    <tr>
                    <td>'.$index + 1 .'</td>
                    <td>'.$row->title.'</td>
                    <td>'.$row->body.'</td>
                    </tr>
                    ';
                }
            } 
            else {
                $output = '
                <tr>
                    <td align="center" colspan="5">No Data Found</td>
                </tr>
                ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );
        return $data;
    }
}
