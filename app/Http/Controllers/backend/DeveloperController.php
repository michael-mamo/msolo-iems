<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function ViewDeveloper(){
        return view('admin.developer');
    }
}
