<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request);

        // Modificando el request
        $request->request->add(['username' => Str::slug($request->username)]);

        $validated = $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => Str::lower($request->email),
            'password' => $request->password
        ]); 

        // Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'), $request->remember );
        

        //Redireccionar al usuario
        return redirect()->route('posts.index', auth()->user()->username);
        

    }    

    

}
