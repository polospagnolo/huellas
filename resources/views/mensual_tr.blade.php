@php
$retraso = getRetraso($empleado,$dia_completo[$key])

@endphp
@if(is_null($retraso))
    <th class="{{$dia > 5 ? 'table-dark' : ''}}"></th>
@else
    <th class="{{$dia > 5 ? 'table-dark' : ''}} text-center {{$retraso->motivo->clase}}" style="cursor: pointer;" data-toggle="tooltip" title="{{$retraso->comentario}}">{{$retraso->motivo->id == 10 ? $retraso->created_at->format('H:i') : $retraso->motivo->letra}}</th>
@endif

