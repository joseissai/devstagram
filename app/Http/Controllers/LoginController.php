<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {        

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        

        // Si falla autenticación mostramos el mensaje de credenciales Incorrectas
        if(!auth()->attempt($request->only('email', 'password'), $request->remember ))
        {
            return back()->with('mensaje','Credenciales Incorrectas');
        }        

        //Redireccionar al usuario al muro
        return redirect()->route('posts.index', auth()->user()->username);
    }    
}
