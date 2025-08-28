<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaFiscalItem extends Model
{
    protected $table = 'nota_fiscal_itens';

    protected $fillable = [
        'nota_fiscal_id',
        'quantidade',
        'valor_unitario',
        'ncm',
        'cest',
        'icms',
        'pis',
        'cofins',
    ];

    protected $casts = [
        'quantidade'     => 'decimal:3',
        'valor_unitario' => 'decimal:2',
        'icms'           => 'decimal:2',
        'pis'            => 'decimal:2',
        'cofins'         => 'decimal:2',
    ];

    public function nota(){ return $this->belongsTo(\App\Models\NotaFiscal::class, 'nota_fiscal_id'); }
    public function ncmItem(){ return $this->belongsTo(\App\Models\Ncm::class, 'ncm'); }

    // Acessor útil para exibição
    public function getTotalAttribute(): float
    {
        return (float)$this->quantidade * (float)$this->valor_unitario;
    }
}
