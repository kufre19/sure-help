<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersMainApp extends Model
{
    use HasFactory;
    protected $table ="users_main_app";

    public static function fetch_user_by_uuid($id)
    {
        $user_model = new UsersMainApp();
        $user = $user_model->where("uuid",$id)->first();
        return $user;
    }
}
