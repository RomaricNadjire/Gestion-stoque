<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MonController extends Controller
{
    //
    public function show()
    {
        $data = "Romaric";
        return Inertia::render('Test', compact('data'));
    }
}
