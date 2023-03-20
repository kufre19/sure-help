<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\AdminFunctions;
use App\Traits\Partnership;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use AdminFunctions, Partnership;
    public function __construct()
    {
        $this->middleware('auth');
    }

    
}
