<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class StockController extends Controller
{    
    public function stock(){
        return Inertia::render('Stock');
    }

    public function registration(){
        return Inertia::render('ProductAdd');
    }

    public function out(){
        return Inertia::render('Out');
    }

    public function commandes(){
        return Inertia::render('Commandes');
    }
}
