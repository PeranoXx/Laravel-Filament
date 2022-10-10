<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Z3d0X\FilamentFabricator\Models\Page;

class HomeController extends Controller
{
    
    public function index(){
        $page = Page::where('layout','default')->get();

        return view('home',['page'=>$page]);
    }
}
