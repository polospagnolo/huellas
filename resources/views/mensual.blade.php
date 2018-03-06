@extends('layouts.app')
@section('css')
    <style>
        .table-des {
            background: #dad55e;
            color: red;
        }

        .table-via {
            background: #adadad;
            color: black;
        }

        .table-ret {
            background: red;
            color: yellow;
        }
    </style>
@endsection
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
                                        <input type="month" class="form-control" id="month" name="month"
                                               value="{{Request::get('month')}}">
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
                    <div class="row">
                        <div class="col-sm-12">
                            @if(request()->has('month'))
                                <table class="table table-bordered table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Empleado</th>
                                        @foreach($dias as $key => $dia)
                                            <th class="{{$dia > 5 ? 'table-dark' : ''}}">{{$fechas[$key]}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($empleados as $empleado)
                                        <tr>
                                            <td>{{$empleado->nombre}}</td>
                                            @foreach($dias as $key => $dia)
                                                @include('mensual_tr')
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
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


