<?php
// app/Models/SimulacaoPreco.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimulacaoPreco extends Model
{
    protected $table = 'simulacoes_precos';

    protected $fillable = [
        'produto_id',
        'preco_custo',
        'frete',
        'outras_despesas',
        'icms',
        'pis',
        'cofins',
        'margem_lucro',
        'margem_calculo',
        'tipo_simulacao',
        'preco_sugerido',
        'observacoes',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
