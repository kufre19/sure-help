<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersMainPost extends Model
{
    use HasFactory;
    public $timestamps = false;



    public static function fetch_pending_post()
    {
     
        $user_post_model = new UsersMainPost();
        $posts = $user_post_model->where("post_status","pending")->orderBy('date_posted', 'desc')->paginate(6);
        return $posts;
    }

    public static function fetch_approved_post()
    {
     
        $user_post_model = new UsersMainPost();
        $posts = $user_post_model->where("post_status","approved")->orderBy('date_updated', 'desc')->paginate(6);
        return $posts;
    }
    public static function fetch_rejected_post()
    {
     
        $user_post_model = new UsersMainPost();
        $posts = $user_post_model->where("post_status","rejected")->orderBy('date_updated', 'desc')->paginate(6);
        return $posts;
    }
}
