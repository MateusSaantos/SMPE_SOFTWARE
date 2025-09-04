<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'descricao',
        'codigo_barras',
        'categoria_produto',
        'margem_lucro',
        'cest',
        'ncm',
        'unidade_medida',
        'preco_custo',
        'preco_venda',
        'estoque',
        'icms',
        'pis',
        'cofins',
        'ativo',

        //campos adicionados
        'origem_mercadoria',
        'aliquota_ipi',
        'ipi_enquadramento',
        'estoque_minimo',
    ];

    protected $casts = [
        'margem_lucro'      => 'decimal:2',
        'preco_custo'       => 'decimal:2',
        'preco_venda'       => 'decimal:2',
        'icms'              => 'decimal:2',
        'pis'               => 'decimal:2',
        'cofins'            => 'decimal:2',
        'ativo'             => 'boolean',

        //casts dos novos campos
        'origem_mercadoria' => 'integer',
        'aliquota_ipi'      => 'decimal:2',
        'estoque_minimo'    => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Normalizações leves
    |--------------------------------------------------------------------------
    */
    public function setCodigoBarrasAttribute($value)
    {
        $v = trim((string) $value);
        $this->attributes['codigo_barras'] = $v === '' ? null : preg_replace('/\D+/', '', $v);
    }

    public function setCestAttribute($value)
    {
        $v = trim((string) $value);
        $this->attributes['cest'] = $v === '' ? null : preg_replace('/\D+/', '', $v);
    }

    //mantém apenas dígitos no enquadramento do IPI; aceita null/''.
    public function setIpiEnquadramentoAttribute($value)
    {
        $v = trim((string) $value);
        $this->attributes['ipi_enquadramento'] = $v === '' ? null : preg_replace('/\D+/', '', $v);
    }

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    */
    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class, 'categoria_produto');
    }

    // evitar conflito com coluna 'ncm' (id) — nomeamos a relação como ncmItem
    public function ncmItem()
    {
        return $this->belongsTo(\App\Models\Ncm::class, 'ncm');
    }
}
