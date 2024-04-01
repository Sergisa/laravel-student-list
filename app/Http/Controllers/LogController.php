<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function show()
    {
        return view('logs', [
            'logs' => Log::all()
        ]);
    }
}
