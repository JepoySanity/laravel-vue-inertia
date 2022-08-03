<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserPageController extends Controller
{
    public function index(){
        return Inertia::render('User/Dashboard');
    }

    public function test(){
        return Inertia::render('User/Dashboard');
    }

}
