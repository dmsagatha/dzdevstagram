<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
  private $imagen_path;
  
  public function __construct()
  {
    $this->imagen_path = public_path('storage/uploads');
  }

  public function store(Request $request)
  {
    /* $imagen         = $request->file('file');
    $nombreImagen   = Str::uuid() . "." . $imagen->extension();
    $imagenServidor = Image::make($imagen);
    $imagenServidor->fit(100, 100);
    $imagenPath = public_path('uploads') . '/' . $nombreImagen;
    $imagenServidor->save($imagenPath); */

    $imagen = $request->file('file');
    
    // Si no existe crear el directorio
    if (!is_dir($this->imagen_path)) {
      mkdir($this->imagen_path);
    }
    
    $nombreImagen = Str::uuid() . "." . $imagen->extension();
    // $nombreImagen = Str::uuid() . "." . $imagen->getClientOriginalExtension();
    
    Image::make($imagen)->resize(100, null, function ($constraint) {
      $constraint->aspectRatio();
    })->save($this->imagen_path . '/' . $nombreImagen);

    return response()->json(['imagen' => $nombreImagen]);
  }
}