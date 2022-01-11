<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class UserController extends Controller
{
    public function userIndex()
    {
        return view('about', [
            'title' => 'About',
            'user' => About::all()
        ]);
    }
}
