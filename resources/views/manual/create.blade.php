@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nueva Entrada / Salida de Empleados</div>
                    <div class="card-body">
                        <form action="{{route('manual.store')}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="row">
                                <div class="col-md-3">
                                    <select name="employee" id="employee" class="form-control">
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->nombre}}">{{$employee->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="type" id="type" class="form-control">
                                        @foreach($options as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="motivo_id" id="motivo_id" class="form-control">
                                        @foreach($motivos as $motivo)
                                            <option value="{{$motivo->id}}">{{$motivo->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="comment" id="comment" class="form-control"
                                           placeholder="Comentario">
                                </div>
                            </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div><!-- .row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection


