<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Salida;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class SalidaController extends Controller
{
    public function index()
    {
        return canUpluad()
            ? view('salida.index')
            : abort(403,'No puedes acceder a esta zona.');
    }
    public function create()
    {
        $employees = Empleado::all();
        return canUpluad()
            ? view('salida.create',compact('employees'))
            : abort(403,'No puedes acceder a esta zona.');
    }

    public function store(Request $request)
    {
        $salida = new Salida();
        $salida->empleado = $request->get('employee');
        $salida->comentario = $request->get('comment');
        $salida->date = $request->get('date');
        $salida->time = $request->get('time');

        $salida->save();

        flash('Salida Espacial Guardada Con Exito!')->success();

        return redirect()->route('salida.index');
    }

    public function edit(Salida $salida)
    {
        $employees = Empleado::all();
        return canUpluad()
            ? view('salida.edit',compact('employees','salida'))
            : abort(403,'No puedes acceder a esta zona.');
    }

    public function update(Salida $salida, Request $request)
    {
        $salida->empleado = $request->get('employee');
        $salida->comentario = $request->get('comment');
        $salida->date = $request->get('date');
        $salida->time = $request->get('time');

        $salida->update();

        flash('Salida Espacial Actualizada Con Exito!')->success();

        return redirect()->route('salida.index');
    }

    public function datatable(Datatables $datatables)
    {
        $builder = Salida::select('*');

        return $datatables->eloquent($builder)
            ->editColumn('date', function ($manual) {
                return date('d-m-Y',strtotime($manual->date));
            })

            ->editColumn('time', function ($manual) {
                return date('H:i',strtotime($manual->time));
            })
            ->addColumn('editar', function($manual){
                return '<a href="'.route('salida.edit',$manual->id).'" class="btn btn-info btn-xs">EDITAR</a>';
            })

            ->rawColumns(['editar'])
            ->make();
    }
}
