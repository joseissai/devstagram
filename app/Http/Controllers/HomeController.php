<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class HomeController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            // Aplica 'auth' a todos los métodos excepto index y show
            new Middleware('auth', except: ['show']),
        ];
    }

    public function __invoke()
    {

        //Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray(); 

        $posts = Post::WhereIn('user_id', $ids)->latest()->paginate(20);;        

        return view('home', ['posts' => $posts]);
    }

}
