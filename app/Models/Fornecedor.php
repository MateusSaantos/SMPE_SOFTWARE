<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';
    protected $primaryKey = 'cnpj';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'inscricao_estadual',
        'telefone',
        'endereco_id',
    ];

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }
}
