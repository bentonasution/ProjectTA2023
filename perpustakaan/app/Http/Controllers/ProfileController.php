<?php

namespace App\Http\Controllers;


use App\Models\Users;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile.index');
    }
    
}