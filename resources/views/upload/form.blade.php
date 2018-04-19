@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Subir Dat <a href="http://192.168.1.201/csl/download" target="_blank" class="pull-right btn btn-info">Descargar Dat</a></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{route('upload.store')}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="file"
                                               accept=".dat" id="file" required>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Subir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection




