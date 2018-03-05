<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Manual;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ManualController extends Controller
{
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
        return view('manual.create',compact('options','employees'));
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
       $manual->save();

       flash('Entrada / Salida guardada con éxito!')->success();

       return redirect()->route('manual.create');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $builder = Manual::select('id', 'empleado', 'tipo', 'comentario' ,'created_at');

        return $datatables->eloquent($builder)
            ->editColumn('created_at', function ($manual) {
                return $manual->created_at->format('d-m-Y H:i:s3');
            })

            ->editColumn('tipo', function ($manual) {
                return config('app.types')[$manual->tipo];
            })

            ->rawColumns(['completada', 'tipo'])
            ->make();
    }
}
