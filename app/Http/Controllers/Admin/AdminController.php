<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\AdminFunctions;
use App\Traits\FreeShopFunction;
use App\Traits\Partnership;
use App\Traits\PostFunctions;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use AdminFunctions, Partnership, PostFunctions, FreeShopFunction;
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $posts = $this->fetch_all_post();
        return view("dashboard",compact("posts"));
    }

    
}
