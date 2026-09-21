<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        // 1. Obtener archivo enviado por Dropzone
        $imagen = $request->file('file');

        // 2. Generar nombre único
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // 3. Crear el gestor usando el driver de GD (sintaxis v4)
        $manager = ImageManager::usingDriver(Driver::class);

        // 4. Leer/decodificar la imagen (en v4 el reemplazo de read() es decode())
        $imagenServidor = $manager->decode($imagen->getRealPath());

        // 5. Recortar a 1000x1000 píxeles proporcionalmente
        $imagenServidor->cover(1000, 1000);

        // 6. Guardar en public/uploads
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        // 7. Retornar nombre para Dropzone
        return response()->json(['imagen' => $nombreImagen]);       
    }
}