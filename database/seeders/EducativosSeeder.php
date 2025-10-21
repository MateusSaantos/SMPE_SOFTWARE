<?php

namespace Database\Seeders;

use App\Models\Educativo;
use Illuminate\Database\Seeder;

class EducativosSeeder extends Seeder
{
    public function run(): void
    {
        $dados = [
            [
                'titulo' => 'CNPJ do zero ao avançado',
                'descricao' => 'Entenda o que é CNPJ, naturezas jurídicas, inscrições e obrigações.',
                'conteudo' => '<h2>O que é CNPJ?</h2><p>...</p>',
                'links' => [
                    ['titulo' => 'Receita Federal — Consulta CNPJ', 'url' => 'https://www.gov.br/receitafederal/pt-br/assuntos/orientacao-tributaria/cadastros/cnpj'],
                ],
                'categorias' => 'cnpj,compliance,basico',
                'visivel' => true, 'visitado' => false, 'status' => 'publicado', 'ordem' => 1,
            ],
            [
                'titulo' => 'Tributação e formação de preços',
                'descricao' => 'Como calcular preço considerando impostos (ICMS, PIS/COFINS, etc.).',
                'conteudo' => '<h2>Formação de preço</h2><p>...</p>',
                'links' => [
                    ['titulo' => 'Lei PIS/COFINS', 'url' => 'https://www.planalto.gov.br/'],
                ],
                'categorias' => 'tributacao,precos,intermediario',
                'visivel' => true, 'visitado' => false, 'status' => 'publicado', 'ordem' => 2,
            ],
            [
                'titulo' => 'Importação de notas (XML NFe)',
                'descricao' => 'Passo a passo para importar NFe XML e conciliar itens.',
                'conteudo' => '<h2>Importando XML</h2><p>...</p>',
                'links' => [
                    ['titulo' => 'Portal NFe', 'url' => 'https://www.nfe.fazenda.gov.br/portal/'],
                ],
                'categorias' => 'nfe,fiscal,avancado',
                'visivel' => true, 'visitado' => false, 'status' => 'publicado', 'ordem' => 3,
            ],
        ];

        foreach ($dados as $d) { Educativo::create($d); }
    }
}
