@extends('layouts.app')
@section('css')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Listado Salida Especiales <a href="{{route('salida.create')}}" class="btn btn-info btn-sm">Nueva Entrada</a></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="manual" class="table table-bordered table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>EMPLEADO</th>
                                        <th>COMENTARIO</th>
                                        <th>FECHA</th>
                                        <th>HORA</th>
                                        <th>EDITAR</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function () {
            var table = $('#manual').dataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 10,
                lengthMenu: [[10, 50, 100], [10, 50, 100]],
                ajax: '{{route('datatable.salida')}}',
                language: {
                    decimal: "",
                    emptyTable: "No hay data esta tabla",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    infoEmpty: "Mostrando 0 de 0 a 0 records",
                    infoFiltered: "(filtrados de _MAX_ totales)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ entradas",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "No hemos encontrado entradas que correspondan",
                    paginate: {
                        first: "Primera",
                        last: "Última",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                    aria: {
                        sortAscending: ": activar para ordernar por esta columna ascendentemente",
                        sortDescending: ": activar para ordernar por esta columna descendentemente"
                    },
                },
                columns: [
                    {data: 'id', name: 'salidas.id'},
                    {data: 'empleado', name: 'salidas.empleado'},
                    {data: 'comentario', name: 'salidas.comentario'},
                    {data: 'date', name: 'salidas.date'},
                    {data: 'time', name: 'salidas.time'},
                    {data: 'editar'}
                ],
                "order": [[ 0, "desc" ]]
            });

        });
    </script>
@stop




