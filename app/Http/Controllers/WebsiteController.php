<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\website;

class WebsiteController extends Controller
{
    public function store(){
        $website = new website;
        $website->url = 'www.sarojadhikari.com.np';
        $website->user_id = 3;
        $website->validated = true;
        $website->category_id = 1;
        $website->status = true;
        $website->save();
    }

    public function index(){
        return website::get();
    }
}
