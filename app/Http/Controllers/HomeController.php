<?php

namespace App\Http\Controllers;

use App\Picado;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
       /* $r = [];
        $fr = fopen(public_path('test.dat'), 'r');
        while (!feof($fr)) {
            $t = substr(utf8_encode(fgets($fr)), 0, -2);
            $partes = explode("\t", $t);
            if (count($partes) == 5) {
                $picado = New Picado();
                $picado->idd = $partes[0];
                $picado->empleado = $partes[1];
                $picado->tiempo = $partes[2];
                $picado->dedo = $partes[3];
                $picado->tipo = $partes[4];

                $picado->save();
                $r[] = $partes;
            }
        }
        fclose($fr);
        return $r;*/

       $p = Picado::take(10)->get();
       dd($p);
    }
}
