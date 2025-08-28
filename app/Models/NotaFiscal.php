<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    protected $table = 'notas_fiscais';

    protected $fillable = [
        'numero','serie','data_emissao','cnpj_dest','fornecedor_cnpj',
        'valor_total','frete','outras_despesas','chave_acesso',
        'status','data_entrada','tipo','observacao',
    ];

    protected $casts = [
        'data_emissao'    => 'date',
        'data_entrada'    => 'date',
        'valor_total'     => 'decimal:2',
        'frete'           => 'decimal:2',
        'outras_despesas' => 'decimal:2',
    ];

    // Normalizações
    public function setCnpjDestAttribute($v){ $this->attributes['cnpj_dest'] = $v ? preg_replace('/\D+/','', $v) : null; }
    public function setFornecedorCnpjAttribute($v){ $this->attributes['fornecedor_cnpj'] = preg_replace('/\D+/','', (string)$v); }
    public function setChaveAcessoAttribute($v){ $this->attributes['chave_acesso'] = $v ? preg_replace('/\D+/','', $v) : null; }

    // Relações
    public function fornecedor(){ return $this->belongsTo(\App\Models\Fornecedor::class, 'fornecedor_cnpj', 'cnpj'); }
    public function itens(){ return $this->hasMany(\App\Models\NotaFiscalItem::class, 'nota_fiscal_id'); }

    // Soma itens (qtd * unit) + frete + outras_despesas
    public function recalcularTotais(): void
    {
        $itens = $this->itens()->get(['quantidade','valor_unitario']);
        $somaItens = 0;
        foreach ($itens as $i) {
            $somaItens += (float)$i->quantidade * (float)$i->valor_unitario;
        }
        $this->valor_total = $somaItens + (float)($this->frete ?? 0) + (float)($this->outras_despesas ?? 0);
        $this->save();
    }
}
