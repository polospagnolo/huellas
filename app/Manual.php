<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    protected $table = 'manual';
    protected $fillable = [
      'empleado',
      'tipo',
      'comentario'
    ];
}
