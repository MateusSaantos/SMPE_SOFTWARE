<?php

// app/Services/CalculadoraPreco.php
namespace App\Services;

use InvalidArgumentException;

class CalculadoraPreco
{
    public static function sugerirPreco(array $in): array
    {
        $custo = (float)($in['preco_custo'] ?? 0) + (float)($in['frete'] ?? 0) + (float)($in['outras_despesas'] ?? 0);
        $t = (float)($in['icms'] ?? 0) + (float)($in['pis'] ?? 0) + (float)($in['cofins'] ?? 0);
        $m = (float)($in['margem_lucro'] ?? 0);
        $modo = $in['margem_calculo'] ?? 'markup';

        if ($custo < 0) throw new InvalidArgumentException('Custo inválido.');
        if ($t < 0 || $t >= 1) throw new InvalidArgumentException('Carga tributária inválida.');
        if ($m < 0 || $m >= 1) throw new InvalidArgumentException('Margem inválida (0..1).');

        if ($modo === 'markup') {
            $den = 1 - $t;
            if ($den <= 0) throw new InvalidArgumentException('Alíquota total inviável para cálculo.');
            $preco = ($custo * (1 + $m)) / $den;
        } else { // margin
            $den = 1 - $m - $t;
            if ($den <= 0) throw new InvalidArgumentException('Alvo de margem inviável dado os tributos.');
            $preco = $custo / $den;
        }

        $tributos = $preco * $t;
        $lucro = $preco - $tributos - $custo;
        $margemEfetiva = $preco > 0 ? $lucro / $preco : 0;
        $markupEfetivo = $custo > 0 ? $lucro / $custo : 0;

        return [
            'custo_base'      => round($custo, 2),
            'preco_sugerido'  => round($preco, 2),
            'tributos_valor'  => round($tributos, 2),
            'lucro_valor'     => round($lucro, 2),
            'margem_efetiva'  => round($margemEfetiva, 4),
            'markup_efetivo'  => round($markupEfetivo, 4),
            't_total'         => round($t, 4),
            'modo'            => $modo,
        ];
    }

    public static function margemAPartirDoPreco(array $in, float $precoAlvo): array
    {
        $custo = (float)($in['preco_custo'] ?? 0) + (float)($in['frete'] ?? 0) + (float)($in['outras_despesas'] ?? 0);
        $t = (float)($in['icms'] ?? 0) + (float)($in['pis'] ?? 0) + (float)($in['cofins'] ?? 0);

        if ($precoAlvo <= 0) throw new InvalidArgumentException('Preço-alvo inválido.');
        if ($t < 0 || $t >= 1) throw new InvalidArgumentException('Carga tributária inválida.');

        $tributos = $precoAlvo * $t;
        $lucro = $precoAlvo - $tributos - $custo;
        $margem = $precoAlvo > 0 ? $lucro / $precoAlvo : 0;
        $markup = $custo > 0 ? $lucro / $custo : 0;

        return [
            'custo_base'      => round($custo, 2),
            'preco_alvo'      => round($precoAlvo, 2),
            'tributos_valor'  => round($tributos, 2),
            'lucro_valor'     => round($lucro, 2),
            'margem_efetiva'  => round($margem, 4),
            'markup_efetivo'  => round($markup, 4),
            't_total'         => round($t, 4),
        ];
    }
}

