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
                                        <input type="week" class="form-control" id="week" name="week"
                                               value="{{Request::get('week')}}">
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
                                    <tr class="table-info">
                                        <th rowspan="2" style="vertical-align: middle;">Empleado</th>
                                        @foreach($t['columnas'] as $columna)
                                            <th colspan="3">{{$columna}}</th>
                                        @endforeach
                                    </tr>
                                    <tr class="table-info">
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
                                            <td class="table-success">{{$key}}</td>

                                            @foreach($value as $val)
                                                @if(count($val) >= 3)
                                                    <td class="{{$val['time'] == 'Error' && $val['type'] < 8 ? 'table-danger' : ''}} {{$val['type'] == '8' ? 'table-success' : ''}} {{isToBeLate($val['day'],$val['entrada'])}}"
                                                        style="cursor: pointer;"
                                                        data-toggle="tooltip"
                                                        title="{{$val['comment']}}">
                                                        <a href="{{route('picado.ampliado',[$key,$val['url']])}}">{{$val['entrada']}}</a>
                                                    </td>
                                                    <td class="{{$val['time'] == 'Error' && $val['type'] < 8 ? 'table-danger' : ''}} {{$val['type'] == '8' ? 'table-success' : ''}}">
                                                        <a href="{{route('picado.ampliado',[$key,$val['url']])}}">{{$val['salida']}}</a>
                                                    </td>
                                                    <td class="{{$val['time'] == 'Error' && $val['type'] < 8 ? 'table-danger' : ''}} {{$val['type'] == '8' ? 'table-success' : ''}}">{{$val['type'] < 8 ? $val['time'] : ''}}</td>
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
@section('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
