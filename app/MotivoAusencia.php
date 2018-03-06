<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoAusencia extends Model
{
    protected  $fillable = [
        'nombre',
        'letra',
        'clase'
    ];
}
