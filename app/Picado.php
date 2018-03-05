<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picado extends Model
{
    protected $fillable = [
        'idd',
        'empleado',
        'tiempo',
        'dedo',
        'tipo',
        'fecha'
    ];

    protected $appends= ['type'];

    public function getTypeAttribute()
    {
        return config('app.types')[$this->tipo];
    }
}
