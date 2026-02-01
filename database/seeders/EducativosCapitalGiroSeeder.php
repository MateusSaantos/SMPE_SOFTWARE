<?php

namespace Database\Seeders;

use App\Models\Educativo;
use Illuminate\Database\Seeder;

class EducativosCapitalGiroSeeder extends Seeder
{
    public function run(): void
    {
        $dados = [

            [
                'titulo' => 'O que é capital de giro?',
                'descricao' => 'Entenda o conceito e por que ele é vital para a empresa.',
                'conteudo' => '<h2>O que é capital de giro</h2>
<p>Capital de giro é o dinheiro necessário para manter a empresa funcionando no dia a dia.</p>
<p>Ele cobre despesas como aluguel, salários, contas e compras.</p>
<p>Não está ligado ao lucro, mas à sobrevivência do negócio.</p>
<p>Mesmo empresas lucrativas podem quebrar sem capital de giro.</p>
<p>Ele garante que a empresa pague suas obrigações no prazo.</p>
<p>É usado antes de receber pelas vendas.</p>
<p>Capital de giro é diferente de investimento.</p>
<p>É essencial para manter operações contínuas.</p>
<p>Empresas pequenas dependem muito dele.</p>
<p>Sem capital de giro, o negócio trava.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Capital de giro', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 1,
            ],

            [
                'titulo' => 'Por que o capital de giro é tão importante?',
                'descricao' => 'Entenda os riscos de não controlar o capital de giro.',
                'conteudo' => '<h2>Importância do capital de giro</h2>
<p>O capital de giro mantém a empresa viva.</p>
<p>Ele evita atrasos em pagamentos.</p>
<p>Permite comprar mercadorias e insumos.</p>
<p>Ajuda a enfrentar períodos de baixa venda.</p>
<p>Sem ele, a empresa depende de empréstimos.</p>
<p>Falta de capital gera endividamento.</p>
<p>Empresas quebram por falta de caixa.</p>
<p>Planejamento evita crises.</p>
<p>Capital de giro traz estabilidade.</p>
<p>Controle financeiro é essencial.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Importância do capital de giro', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 2,
            ],

            [
                'titulo' => 'Capital de giro x lucro',
                'descricao' => 'Entenda a diferença entre lucro e dinheiro em caixa.',
                'conteudo' => '<h2>Lucro não é caixa</h2>
<p>Lucro é o resultado da operação.</p>
<p>Capital de giro é dinheiro disponível.</p>
<p>Uma empresa pode ter lucro e não ter caixa.</p>
<p>Vendas a prazo afetam o capital.</p>
<p>Despesas fixas consomem o caixa.</p>
<p>Confundir os dois gera erros graves.</p>
<p>Controle financeiro evita confusão.</p>
<p>Fluxo de caixa mostra a realidade.</p>
<p>Lucro aparece no resultado.</p>
<p>Caixa mantém a empresa funcionando.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Lucro e capital de giro', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 3,
            ],

            [
                'titulo' => 'Como calcular o capital de giro',
                'descricao' => 'Aprenda a calcular o capital de giro necessário.',
                'conteudo' => '<h2>Cálculo do capital de giro</h2>
<p>O capital de giro é calculado pelas necessidades do negócio.</p>
<p>Considere despesas fixas e variáveis.</p>
<p>Analise prazos de recebimento.</p>
<p>Analise prazos de pagamento.</p>
<p>Quanto maior o prazo de recebimento, maior a necessidade.</p>
<p>Estoque também impacta o cálculo.</p>
<p>Negócios diferentes têm valores diferentes.</p>
<p>Planejamento é essencial.</p>
<p>O cálculo evita surpresas.</p>
<p>Reveja periodicamente.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Como calcular capital de giro', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 4,
            ],

            [
                'titulo' => 'Capital de giro e fluxo de caixa',
                'descricao' => 'A relação entre capital de giro e fluxo de caixa.',
                'conteudo' => '<h2>Fluxo de caixa e capital de giro</h2>
<p>Fluxo de caixa registra entradas e saídas.</p>
<p>Ele mostra a saúde financeira.</p>
<p>Capital de giro depende do fluxo.</p>
<p>Fluxo negativo consome capital.</p>
<p>Controle diário é recomendado.</p>
<p>Antecipar problemas evita crises.</p>
<p>ERP facilita o controle.</p>
<p>Relatórios ajudam decisões.</p>
<p>Fluxo bem feito garante estabilidade.</p>
<p>Capital de giro agradece.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Fluxo de caixa', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 5,
            ],

            [
                'titulo' => 'Principais erros no capital de giro',
                'descricao' => 'Evite erros comuns que afetam o caixa.',
                'conteudo' => '<h2>Erros comuns</h2>
<p>Misturar finanças pessoais com a empresa.</p>
<p>Vender muito a prazo sem controle.</p>
<p>Não acompanhar o fluxo de caixa.</p>
<p>Manter estoque excessivo.</p>
<p>Ignorar despesas fixas.</p>
<p>Não planejar impostos.</p>
<p>Depender de empréstimos constantes.</p>
<p>Falta de planejamento financeiro.</p>
<p>Erros simples causam grandes problemas.</p>
<p>Educação financeira evita falhas.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Erros financeiros', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 6,
            ],

            [
                'titulo' => 'Capital de giro e vendas a prazo',
                'descricao' => 'Impacto das vendas parceladas no caixa.',
                'conteudo' => '<h2>Vendas a prazo</h2>
<p>Vendas a prazo aumentam faturamento.</p>
<p>Mas reduzem o caixa imediato.</p>
<p>Prazo longo exige mais capital de giro.</p>
<p>Controle de recebimentos é essencial.</p>
<p>Inadimplência afeta o caixa.</p>
<p>Política de crédito evita problemas.</p>
<p>ERP ajuda no controle.</p>
<p>Planeje antes de parcelar.</p>
<p>Venda consciente é saudável.</p>
<p>Caixa precisa ser protegido.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Vendas a prazo', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 7,
            ],

            [
                'titulo' => 'Estoque e capital de giro',
                'descricao' => 'Como o estoque afeta o capital de giro.',
                'conteudo' => '<h2>Estoque e capital</h2>
<p>Estoque parado é dinheiro parado.</p>
<p>Excesso consome capital de giro.</p>
<p>Falta de estoque gera perda de vendas.</p>
<p>Controle equilibrado é essencial.</p>
<p>Giro de estoque melhora o caixa.</p>
<p>Compras planejadas evitam desperdício.</p>
<p>ERP ajuda no controle.</p>
<p>Relatórios mostram excesso.</p>
<p>Estoque saudável protege o caixa.</p>
<p>Planejamento é chave.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Gestão de estoque', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 8,
            ],

            [
                'titulo' => 'Como melhorar o capital de giro',
                'descricao' => 'Ações práticas para melhorar o caixa.',
                'conteudo' => '<h2>Melhoria do capital de giro</h2>
<p>Reduza prazos de recebimento.</p>
<p>Negocie prazos maiores com fornecedores.</p>
<p>Controle despesas fixas.</p>
<p>Evite estoques excessivos.</p>
<p>Planeje impostos.</p>
<p>Use relatórios financeiros.</p>
<p>Revise preços e margens.</p>
<p>Controle inadimplência.</p>
<p>Educação financeira é essencial.</p>
<p>Gestão ativa melhora o caixa.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Como melhorar capital de giro', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 9,
            ],

            [
                'titulo' => 'Capital de giro e crescimento da empresa',
                'descricao' => 'Por que crescer sem capital de giro é perigoso.',
                'conteudo' => '<h2>Crescimento e capital de giro</h2>
<p>Crescer exige mais capital de giro.</p>
<p>Mais vendas geram mais despesas.</p>
<p>Expansão sem planejamento gera crise.</p>
<p>Contratações aumentam custos.</p>
<p>Estoque cresce junto.</p>
<p>Planejar crescimento é essencial.</p>
<p>Capital sustenta a expansão.</p>
<p>Crescimento saudável é sustentável.</p>
<p>ERP ajuda no planejamento.</p>
<p>Crescer com controle evita falência.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Crescimento empresarial', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 10,
            ],

            [
                'titulo' => 'Quando buscar crédito para capital de giro?',
                'descricao' => 'Entenda quando o crédito pode ser uma solução.',
                'conteudo' => '<h2>Crédito e capital de giro</h2>
<p>Crédito pode ajudar em momentos pontuais.</p>
<p>Não deve ser solução permanente.</p>
<p>Analise juros e prazos.</p>
<p>Use crédito para manter operações.</p>
<p>Evite pagar despesas fixas sempre com empréstimo.</p>
<p>Planejamento evita endividamento.</p>
<p>Use crédito de forma consciente.</p>
<p>Sebrae oferece orientação.</p>
<p>Controle financeiro é prioridade.</p>
<p>Crédito mal usado vira problema.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Crédito para empresas', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 11,
            ],

            [
                'titulo' => 'Capital de giro como indicador de saúde financeira',
                'descricao' => 'Use o capital de giro como termômetro do negócio.',
                'conteudo' => '<h2>Indicador financeiro</h2>
<p>Capital de giro mostra a saúde do negócio.</p>
<p>Baixo capital indica risco.</p>
<p>Capital positivo traz segurança.</p>
<p>Indicadores ajudam decisões.</p>
<p>Monitorar regularmente é essencial.</p>
<p>ERP facilita acompanhamento.</p>
<p>Relatórios mostram tendências.</p>
<p>Ajustes evitam crises.</p>
<p>Gestão financeira é contínua.</p>
<p>Capital de giro é estratégico.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Indicadores financeiros', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Capital de Giro',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 12,
            ],

        ];

        foreach ($dados as $dado) {
            Educativo::create($dado);
        }
    }
}
