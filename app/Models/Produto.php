<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'descricao',
        'codigo_barras',
        'imagem', // ✅ NOVO
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

        // campos adicionados
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

        'origem_mercadoria' => 'integer',
        'aliquota_ipi'      => 'decimal:2',
        'estoque_minimo'    => 'integer',
    ];

    /*
    |------------------------------------------------------------------
    | Accessors
    |------------------------------------------------------------------
    */

    // URL completa da imagem do produto
    public function getImagemUrlAttribute()
    {
        if ($this->imagem && Storage::disk('public')->exists('produtos/' . $this->imagem)) {
            return asset('storage/produtos/' . $this->imagem);
        }

        // imagem padrão (opcional)
        return asset('images/produto-sem-imagem.png');
    }

    /*
    |------------------------------------------------------------------
    | Normalizações
    |------------------------------------------------------------------
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

    public function setIpiEnquadramentoAttribute($value)
    {
        $v = trim((string) $value);
        $this->attributes['ipi_enquadramento'] = $v === '' ? null : preg_replace('/\D+/', '', $v);
    }

    /*
    |------------------------------------------------------------------
    | Relacionamentos
    |------------------------------------------------------------------
    */
    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class, 'categoria_produto');
    }

    public function ncmItem()
    {
        return $this->belongsTo(\App\Models\Ncm::class, 'ncm');
    }
}
