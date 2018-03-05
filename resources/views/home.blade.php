@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Picado</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{url()->current()}}" method="get">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input type="week" class="form-control" id="week" name="week" value="{{Request::get('week')}}">
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Calcular</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if(is_array($t))
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">Empleado</th>
                                        @foreach($t['columnas'] as $columna)
                                            <th colspan="3">{{$columna}}</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach($t['days'] as $day)
                                            <th>Entrada</th>
                                            <th>Salida</th>
                                            <th>Tiempo</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($t['empleados'] as $key => $value)
                                        <tr>
                                            <td>{{$key}}</td>

                                            @foreach($value as $val)
                                                @if(count($val) >= 3)
                                                    <td class="{{$val['time'] == 'Error' ? 'table-danger' : ''}} {{isToBeLate($val['day'],$val['entrada'])}}">{{$val['entrada']}}</td>
                                                    <td class="{{$val['time'] == 'Error' ? 'table-danger' : ''}}">{{$val['salida']}}</td>
                                                    <td class="{{$val['time'] == 'Error' ? 'table-danger' : ''}}">{{$val['time']}}</td>
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
