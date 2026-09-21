<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Hash;



class PerfilController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            // Aplica 'auth' a todos los métodos excepto index y show
            new Middleware('auth', except: ['show']),
        ];
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        // Modificando el request
        $request->request->add(['username' => Str::slug($request->username)]);

        $validated = $request->validate([
            'name' => ['required','min:3','max:60' ],
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20', 'not_in:twitter,editar-perfil', ],            
            'email' => ['required','unique:users,email,'.auth()->user()->id,'min:3','max:60' ],
            'password_actual' => ['nullable', 'required_with:password', 'current_password'],
            'password' => ['nullable', 'required_with:password_actual', 'confirmed', 'min:3'],
        ]);        

        // Validación para la imagen
        if($request->imagen)
        {
            // 1. Obtener archivo enviado por Dropzone
            $imagen = $request->file('imagen');

            // 2. Generar nombre único
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            // 3. Crear el gestor usando el driver de GD (sintaxis v4)
            $manager = ImageManager::usingDriver(Driver::class);

            // 4. Leer/decodificar la imagen (en v4 el reemplazo de read() es decode())
            $imagenServidor = $manager->decode($imagen->getRealPath());

            // 5. Recortar a 1000x1000 píxeles proporcionalmente
            $imagenServidor->cover(1000, 1000);

            // 6. Guardar en public/uploads
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);

        }
        
        // Guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->name = $request->name;
        $usuario->username = $request->username;
        $usuario->email = $request->email;

        // Si llenó el password, si lo guarda
        if ($request->filled('password')) 
        {
            $usuario->password = Hash::make($request->password);
        }        

        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';

        $usuario->save();

        // Redireccionar al usuario
        return redirect()->route('posts.index', $usuario->username);

    }


}
