<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Picado;
use App\Salida;
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
        if (!$request->has('week') || is_null($request->get('week'))) {
            $t = null;
            return view('home', compact('t'));
        }
        $partes = explode('-', $request->get('week'));
        setlocale(LC_TIME, 'Spanish');
        $end = \Carbon\Carbon::now();
        $end->setISODate($partes[0], substr($partes[1], -2));
        //dd($end->formatLocalized('%A'));
        $star = \Carbon\Carbon::now();
        $star->setISODate($partes[0], substr($partes[1], -2));


        $empleados = Picado::select('empleado')
            ->whereBetween('fecha', [$star->startOfWeek(), $end->endOfWeek()])
            ->distinct('empleado')
            ->orderBy('empleado', 'ASC')
            ->get();

        if (!$empleados->count()) {
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
                    $horas = Picado::where('empleado', $empleado->empleado)->where('fecha', $star->toDateString())->orderBy('id', 'asc')->get();
                    $t['empleados'][$empleado->empleado][$star->toDateString()] = $this->isCorrect($horas);
                    if (!in_array($t['days'][$i] . " " . $star->format('d-m-Y'), $t['columnas'])) {
                        array_push($t['columnas'], $t['days'][$i] . " " . $star->format('d-m-Y'));
                    }
                } else {
                    $horas = Picado::where('empleado', $empleado->empleado)->where('fecha', $star->addDay(1)->toDateString())->orderBy('id', 'asc')->get();
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
                'entrada' => 'MOTIVO',
                'salida'  => '',
                'time'    => 'Error',
                'day'     => '',
                'url'     => $collection->first()->fecha,
                'type' => $collection->first()->tipo,
                'comment' => $collection->first()->comentario,
            ];
    }

    public function getTimeWorked(Collection $collection)
    {
        $time = null;

        $col = $collection->toArray();
        $m = 2;
        for ($i = 0; $i < $collection->count(); $i += 2) {
            $f1 = new \DateTime($col[$i]['tiempo']);
            $f2 = new \DateTime(($col[$i + 1]['tiempo']));
            $intervalo = $f1->diff($f2);
            // dd($intervalo->h);
            if ($time == null) {
                $time['time'] = date('H:i', strtotime($intervalo->format('%H:%i')));
                $time['url'] = date('Y-m-d', strtotime($col[$i]['tiempo']));
                $time['day'] = date('N', strtotime($col[$i]['tiempo']));
            } else {

                $time['day'] = date('N', strtotime($col[$i]['tiempo']));
                $time['url'] = date('Y-m-d', strtotime($col[$i]['tiempo']));
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
            $time['type'] = $col[$i]['tipo'];
            $time['comment'] = $col[$i]['comentario'];
            $m++;

        }

        return $time;
    }


    public function aplicado($empleado, $day)
    {
        $picado = Picado::where('empleado', $empleado)
            ->where('fecha', $day)
            ->orderBy('id', 'asc')
            ->get();

        $salidas = Salida::where('empleado', $empleado)
            ->where('date', $day)
            ->orderBy('id', 'asc')
            ->get();

        return view('ampliado', compact('empleado', 'day', 'picado','salidas'));
    }

    public function mensual(Request $request)
    {
        if (!$request->has('month')) {
            return view('mensual');
        }
        \Carbon\Carbon::setLocale('es');
        $partes = explode('-', $request->get('month'));
        $year = $partes[0];
        $month = $partes[1];
        $c = \Carbon\Carbon::create($year, $month, '01');

        $ini = $c->firstOfMonth()->format('Y-m-d');
        $fin = $c->lastOfMonth()->format('Y-m-d');

        $fechas = date_range($ini, $fin, "+1 day", "d");
        $dias = date_range($ini, $fin, "+1 day", "N");
        $dia_completo = date_range($ini, $fin, "+1 day", "Y-m-d");

        $empleados = Empleado::select('nombre')->orderBy('nombre', 'ASC')->get();

        return view('mensual', compact('t', 'fechas', 'dias', 'empleados', 'dia_completo'));
    }

    public function comment(Picado $picado)
    {
        return view('comment', compact('picado'));
    }

    public function saveComment(Picado $picado, Request $request)
    {
        $picado->comentario = $request->get('comentario');
        $picado->update();

        flash('Comentario agregado correctamente!')->success();
        return redirect()->back();
    }

}
