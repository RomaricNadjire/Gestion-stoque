<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\facades\Redirecr;
use App\Models\User;
use Inertia\Inertia;

class MonController extends Controller
{
    //
    public function login()
    {
        return Inertia::render('Login');
    }

    public function registration()
    {
        return Inertia::render('Register');
    }

    public function loger(Request $request)
    {
        $valiide = $request->validate([
            'email'=>['email','required'],
            'password'=>['required']
        ]);

        if(Auth::attempt($valiide)){
            $request->session()->regenerate();
            return redirect()->action([StockController::class, 'stock']);
        }else{
            return Inertia::render('Login')->with('error', 'Mot de passe ou email incorect');
        }
    }

    public function registratrer(userRequest $request)
    {
        if($request->password == $request->confpassword)
        {
            User::create([
                'name'=>$request->name,
                'email'=>$request->email, 
                'password'=>$request->password
            ]);
            return redirect()->route('login')->with('message', 'Vous avez bien été enregistré');
        }
        else
        {
            return Inertia::render('Register')->with('error', 'La confirmation n\'est pas correcte');
        }
    }

    public function deconnexion()
    {
        Auth::logout();
        return redirect()->back();
    }

}