@php
    $retraso = getRetraso($empleado,$dia_completo[$key])

@endphp
@if(is_null($retraso))
    <td class="{{$dia > 5 ? 'table-dark' : ''}} text-center" style="cursor: pointer;">
        @if($dia < 6)
            <a href="{{url('picado/ampliado/'.$empleado->nombre.'/'.$dia_completo[$key])}}">Ver</a>
        @endif
    </td>
@else
    <td class="{{$dia > 5 ? 'table-dark' : ''}} text-center {{$retraso->motivo->clase}}" style="cursor: pointer;"
        data-toggle="tooltip"
        title="{{$retraso->comentario}}">
        @if($dia < 6)
            <a href="{{url('picado/ampliado/'.$empleado->nombre.'/'.$dia_completo[$key])}}">{{$retraso->motivo->id == 10 ? $retraso->created_at->format('H:i') : $retraso->motivo->letra}}</a>
        @endif
    </td>
@endif

