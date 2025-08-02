<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'cep', 'uf', 'cidade', 'bairro', 'numero', 'logradouro', 'complemento'
    ];

    public function empresas() {
        return $this->hasMany(Empresa::class);
    }
}
