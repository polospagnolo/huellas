@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Detalle del día <strong>{{$day}}</strong> del empleado
                        <strong>{{$empleado}}</strong> <a class="btn btn-success pull-right" href="{{redirect()->back()->getTargetUrl()}}">VOLVER</a></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Empleado</th>
                                        <th>Fecha y Hora</th>
                                        <th>Dedo</th>
                                        <th>Tipo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($picado))
                                        @foreach($picado as $pi)
                                            <tr>
                                                <td>{{$pi->empleado}}</td>
                                                <td>{{$pi->tiempo}}</td>
                                                <td>{{$pi->dedo == 1 ? 'Sí' : 'No'}}</td>
                                                <td>{{$pi->type}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
