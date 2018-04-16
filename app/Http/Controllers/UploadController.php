<?php

namespace App\Http\Controllers;

use App\Picado;
use App\Uploads;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showForm()
    {
        return view('upload.form');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = "upload_".date('dmYHis').".dat";

        $destinationPath = public_path('uploads');
        $file->move($destinationPath,$name);

        $upload = New Uploads();
        $upload->file = $name;
        $upload->user_id = auth()->id();
        $upload->save();

        return $this->load($name);


    }

    public function load($name)
    {
        $r = [];
        $path = "uploads/".$name;

        $fr = fopen(public_path($path), 'r');
        while (!feof($fr)) {
            $t = substr(utf8_encode(fgets($fr)), 0, -2);
            $partes = explode("\t", $t);

            if (count($partes) == 5) {
                $picado = New Picado();
                $picado->idd = $partes[0];
                $picado->empleado = $partes[1];
                $picado->tiempo = $partes[2];
                $picado->dedo = $partes[3];
                $picado->tipo = intval($partes[4]);
                $picado->fecha = $partes[2];
                $picado->save();
                $r[] = $partes;
            }
        }

        fclose($fr);
        flash('Archivo subido correctamente!')->success();
        return redirect()->route('upload.form');
    }
}
