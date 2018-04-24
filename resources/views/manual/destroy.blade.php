<form method="post" action="{{route('manual.destroy',$manual->id)}}">
    <input type="hidden" name="_method" value="delete">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <button type="submit" class="delete btn btn-danger">ELIMINAR</button>
</form>

