<?php

namespace App\Http\Controllers;

use App\Picado;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
    public function index(Request $request)
    {
        if (!$request->has('week')) {
            $t = null;
            return view('home', compact('t'));
        }
        $partes = explode('-', $request->get('week'));
        //dd($partes);
        setlocale(LC_TIME, 'Spanish');
        $end = \Carbon\Carbon::now();
        $end->setISODate($partes[0], substr($partes[1], -1));
        //dd($end->formatLocalized('%A'));
        $star = \Carbon\Carbon::now();
        $star->setISODate($partes[0], substr($partes[1], -1));


        $empleados = Picado::select('empleado')
            ->whereBetween('fecha', [$star->startOfWeek(), $end->endOfWeek()])
            ->distinct('empleado')
            ->get();

        if(!$empleados->count())
        {
            $t = null;
            return view('home', compact('t'));
        }

        $t = [];
        $t['days'] = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $t['columnas'] = [];
        foreach ($empleados as $empleado) {
            $t['empleados'][$empleado->empleado] = [];

            for ($i = 0; $i < 7; $i++) {
                if ($i == 0) {
                    $horas = Picado::where('empleado', $empleado->empleado)->where('fecha', $star->toDateString())->get();
                    $t['empleados'][$empleado->empleado][$star->toDateString()] = $this->isCorrect($horas);
                    if (!in_array($t['days'][$i] . " " . $star->format('d-m-Y'), $t['columnas'])) {
                        array_push($t['columnas'],$t['days'][$i] . " " . $star->format('d-m-Y'));
                    }
                } else {
                    $horas = Picado::where('empleado', $empleado->empleado)->where('fecha', $star->addDay(1)->toDateString())->get();
                    $t['empleados'][$empleado->empleado][$star->toDateString()] = $this->isCorrect($horas);
                    if (!in_array($t['days'][$i] . " " . $star->format('d-m-Y'), $t['columnas'])) {
                        array_push($t['columnas'], $t['days'][$i] . " " . $star->format('d-m-Y'));
                    }
                }

                if ($i == 6) {
                    $star->subDays(6);
                }
            }
        }
        //dd($t);
        return view('home', compact('t'));
    }

    public function isCorrect(Collection $collection)
    {
        return $collection->count() % 2 == 0
            ? $this->getTimeWorked($collection)
            : [
                'entrada' => '',
                'salida' => '',
                'time' => 'Error',
                'day' => 0
            ];
    }

    public function getTimeWorked(Collection $collection)
    {
        $time = null;

        $col = $collection->toArray();
        $m = 1;
        for ($i = 0; $i < $collection->count(); $i += 2) {
            $f1 = new \DateTime($col[$i]['tiempo']);
            $f2 = new \DateTime(($col[$i + 1]['tiempo']));
            $intervalo = $f1->diff($f2);
            // dd($intervalo->h);
            if ($time == null) {
                $time['time'] = date('H:i', strtotime($intervalo->format('%H:%i')));

                $time['day'] = date('N',strtotime($col[$i]['tiempo']));
            } else {

                $time['day'] = date('N',strtotime($col[$i]['tiempo']));
                if ($m % 2 == 0) {
                    $time['time'] = date('H:i', strtotime($time['time'] . " + " . $intervalo->h . "hours + " . $intervalo->i . " minutes"));
                } else {
                    $time['time'] = date('H:i', strtotime($time['time'] . " - " . $intervalo->h . "hours - " . $intervalo->i . " minutes"));
                }

            }

            if ($i == 0) {
                $time['entrada'] = date('H:i:s', strtotime($col[$i]['tiempo']));
            }
            if ($i + 1 == count($col) - 1) {
                $time['salida'] = date('H:i:s', strtotime($col[$i + 1]['tiempo']));
            }

            $m++;

        }

        return $time;
    }

    public function load()
    {
        $r = [];
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
              $picado->fecha = $partes[2];

              $picado->save();
              $r[] = $partes;
          }
      }
      fclose($fr);
     return redirect()->route('home');
    }


}
