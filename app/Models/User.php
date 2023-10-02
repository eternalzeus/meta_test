<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Http\Helpers\CustomPaginator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable  // map to users table, derive class User from class Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class,'user_id'); // User quan hệ 1 nhiều vs Post thông qua user_id là foreign key
    } 
    
    public function products()
    {   
        return $this->hasMany(Post::class,'user_id'); // User quan hệ 1 nhiều vs Post thông qua user_id là foreign key
    } 

    public static function searchProduct($request)
    {
        $products = DB::table('products');
        if(!empty($request->title)){
            $products = $products->where('title',"LIKE",'%'.$request->title.'%');
        }
        $products = $products->get();
        $r = [];
        $res = self::paginate($r)->appends($request->all());
        
        return $res;
    }

    private static function paginate($items, $perPage = 3, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new CustomPaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
