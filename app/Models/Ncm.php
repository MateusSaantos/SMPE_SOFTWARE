<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ncm extends Model
{
    protected $table = 'ncms';

    protected $fillable = [
        'codigo',
        'descricao',
    ];

    // Guarda só dígitos no código
    public function setCodigoAttribute($value)
    {
        $this->attributes['codigo'] = preg_replace('/\D+/', '', (string) $value);
    }
}
