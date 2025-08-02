<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $primaryKey = 'cnpj';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cnpj', 'razao_social', 'nome_fantasia', 'telefone', 'endereco_id',
        'inscricao_estadual', 'data_abertura', 'porte', 'email', 'regime_tributario',
        'cnae', 'optante_mei', 'status'
    ];

    public function endereco() {
        return $this->belongsTo(Endereco::class);
    }
}
