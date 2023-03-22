<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
  public function store(Request $request)
  {
    $imagen         = $request->file('file');
    $nombreImagen   = Str::uuid() . "." . $imagen->extension();
    $imagenServidor = Image::make($imagen); // image::Class esta clase nos permite crear una imagen de intervention.io
    $imagenServidor->fit(100, 100);
    $imagenPath = public_path('uploads') . '/' . $nombreImagen;
    $imagenServidor->save($imagenPath);

    return response()->json(['imagen' => $nombreImagen]);
  }
}