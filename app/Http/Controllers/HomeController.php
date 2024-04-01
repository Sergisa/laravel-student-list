<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the resource.
     */
    public function show()
    {
        //echo User::all()->toJson();
        return view('welcome', [
            'users' => User::all()
        ]);
    }
}
