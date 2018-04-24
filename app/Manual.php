<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    protected $table = 'manual';

    protected $fillable = [
        'empleado',
        'tipo',
        'comentario',
        'motivo_id',
        'time',
    ];

    protected $appends= ['type'];

    public function motivo()
    {
        return $this->belongsTo(MotivoAusencia::class);
    }

    public function getTypeAttribute()
    {
        return config('app.types')[$this->tipo];
    }

    public function routeDelete()
    {
        return route('manual.destroy',$this);
    }
}
