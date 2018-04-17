@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nueva Salida Especial</div>
                    <div class="card-body">
                        <form action="{{route('salida.store')}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="employee" id="employee" class="form-control">
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->nombre}}">{{$employee->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="time" name="time" id="time" required class="form-control"
                                           value="{{date('H:i')}}">
                                </div>
                                <div class="col-md-4">
                                    <input type="date" name="date" id="date" required class="form-control">
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



