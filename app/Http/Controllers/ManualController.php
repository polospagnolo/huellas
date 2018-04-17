<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Manual;
use App\MotivoAusencia;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ManualController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manual.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = config('app.types');
        $employees = Empleado::all();
        $motivos = MotivoAusencia::all();
        return view('manual.create',compact('options','employees','motivos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $manual = New Manual();
       $manual->empleado = $request->get('employee');
       $manual->tipo = $request->get('type');
       $manual->comentario = $request->has('comment') ? $request->get('comment') : null;
       $manual->motivo_id = $request->get('motivo_id');
       $manual->time = $request->get('time');
       $manual->save();

       flash('Entrada / Salida guardada con éxito!')->success();

       return redirect()->route('manual.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Manual $manual)
    {
        $options = config('app.types');
        $employees = Empleado::all();
        $motivos = MotivoAusencia::all();
        return view('manual.edit',compact('options','employees','motivos','manual'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manual $manual)
    {
        $manual->empleado = $request->get('employee');
        $manual->tipo = $request->get('type');
        $manual->comentario = $request->has('comment') ? $request->get('comment') : null;
        $manual->motivo_id = $request->get('motivo_id');
        $manual->time = $request->get('time');
        $manual->update();

        flash('Entrada / Salida actualizada con éxito!')->success();
        return redirect()->route('manual.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function datatable(Datatables $datatables)
    {
        $builder = Manual::with('motivo');

        return $datatables->eloquent($builder)
            ->editColumn('created_at', function ($manual) {
                return $manual->created_at->format('d-m-Y')." ".$manual->time;
            })

            ->editColumn('tipo', function ($manual) {
              return $manual->type;
            })
            ->addColumn('nombre', function($manual){
                $manual->motivo->nombre;
            })
            ->addColumn('editar', function($manual){
                return '<a href="'.route('manual.edit',$manual->id).'" class="btn btn-info btn-xs">EDITAR</a>';
            })

            ->rawColumns(['completada', 'tipo','editar'])
            ->make();
    }
}
