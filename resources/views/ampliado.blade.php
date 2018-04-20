@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Detalle del día <strong>{{$day}}</strong> del empleado
                        <strong>{{$empleado}}</strong> <a class="btn btn-success pull-right"
                                                          href="{{redirect()->back()->getTargetUrl()}}">VOLVER</a></div>
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
                                        <th>Comentario</th>
                                        <th width="1%"></th>
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
                                                <td>{{$pi->comentario}}</td>
                                                <td>
                                                    @if(canUpluad())
                                                        <button type="button" class="btn btn-primary brn-sm"
                                                                data-toggle="modal" data-target="#modal_{{$pi->id}}">
                                                            Añadir
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Salidas Especiales -->
                        <h2>Salidas Especiales</h2>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Empleado</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Comentario</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($salidas))
                                        @foreach($salidas as $salida)
                                            <tr>
                                                <td>{{$salida->empleado}}</td>
                                                <td>{{$salida->date}}</td>
                                                <td>{{$salida->time}}</td>
                                                <td>{{$salida->comentario}}</td>
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
    @foreach($picado as $pi)
        @include('comment',$pi)
    @endforeach
@endsection
