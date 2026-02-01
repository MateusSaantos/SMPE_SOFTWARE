<?php

namespace Database\Seeders;

use App\Models\Educativo;
use Illuminate\Database\Seeder;

class EducativosRiscosErrosComunsSeeder extends Seeder
{
    public function run(): void
    {
        $dados = [

            [
                'titulo' => 'Por que conhecer os riscos do negócio?',
                'descricao' => 'Entenda a importância de identificar riscos e erros.',
                'conteudo' => '<h2>Riscos fazem parte do negócio</h2>
<p>Todo negócio possui riscos.</p>
<p>Ignorá-los aumenta a chance de falência.</p>
<p>Conhecer riscos permite prevenção.</p>
<p>Empresas pequenas são mais vulneráveis.</p>
<p>Planejamento reduz impactos negativos.</p>
<p>Riscos financeiros são os mais comuns.</p>
<p>Riscos operacionais também afetam.</p>
<p>Gestão consciente protege a empresa.</p>
<p>Educação evita erros repetidos.</p>
<p>Prevenir é sempre mais barato.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Gestão de riscos', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 1,
            ],

            [
                'titulo' => 'Misturar finanças pessoais com a empresa',
                'descricao' => 'Um dos erros mais comuns entre pequenos empresários.',
                'conteudo' => '<h2>Finanças pessoais x empresariais</h2>
<p>Misturar contas gera descontrole financeiro.</p>
<p>Dificulta saber se a empresa dá lucro.</p>
<p>Compromete o capital de giro.</p>
<p>Prejudica decisões estratégicas.</p>
<p>É comum em microempresas.</p>
<p>Conta bancária separada é essencial.</p>
<p>Pró-labore deve ser definido.</p>
<p>Organização traz clareza.</p>
<p>Separação evita problemas futuros.</p>
<p>Controle financeiro começa aqui.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Separação de finanças', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 2,
            ],

            [
                'titulo' => 'Falta de controle financeiro',
                'descricao' => 'Não controlar números é um risco grave.',
                'conteudo' => '<h2>Controle financeiro</h2>
<p>Sem controle não há gestão.</p>
<p>Empresários perdem visão do negócio.</p>
<p>Fluxo de caixa é ignorado.</p>
<p>Despesas passam despercebidas.</p>
<p>Lucro real não é conhecido.</p>
<p>Decisões são tomadas no achismo.</p>
<p>ERP facilita o controle.</p>
<p>Relatórios ajudam no planejamento.</p>
<p>Controle evita surpresas.</p>
<p>Gestão financeira é essencial.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Controle financeiro', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 3,
            ],

            [
                'titulo' => 'Não planejar impostos',
                'descricao' => 'Erro comum que gera dívidas e multas.',
                'conteudo' => '<h2>Planejamento tributário</h2>
<p>Impostos fazem parte do negócio.</p>
<p>Ignorá-los gera multas.</p>
<p>Empresas quebram por dívidas fiscais.</p>
<p>Planejamento evita surpresas.</p>
<p>Simples Nacional exige atenção.</p>
<p>Prazos devem ser respeitados.</p>
<p>Controle mensal é necessário.</p>
<p>ERP ajuda no acompanhamento.</p>
<p>Organização evita problemas legais.</p>
<p>Educação tributária é fundamental.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Planejamento tributário', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 4,
            ],

            [
                'titulo' => 'Crescer sem planejamento',
                'descricao' => 'Crescer rápido demais pode quebrar a empresa.',
                'conteudo' => '<h2>Crescimento desorganizado</h2>
<p>Crescer exige mais capital.</p>
<p>Aumenta despesas e riscos.</p>
<p>Sem planejamento o caixa sofre.</p>
<p>Contratações elevam custos.</p>
<p>Estoque aumenta.</p>
<p>Vendas a prazo crescem.</p>
<p>Planejamento sustenta crescimento.</p>
<p>Crescer com controle é essencial.</p>
<p>ERP ajuda no planejamento.</p>
<p>Crescimento saudável é sustentável.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Crescimento empresarial', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 5,
            ],

            [
                'titulo' => 'Precificar errado',
                'descricao' => 'Preço errado pode gerar prejuízo mesmo vendendo muito.',
                'conteudo' => '<h2>Erro na precificação</h2>
<p>Preço baixo demais gera prejuízo.</p>
<p>Preço alto afasta clientes.</p>
<p>Custos devem ser considerados.</p>
<p>Impostos impactam o preço.</p>
<p>Margem de lucro é essencial.</p>
<p>Concorrência deve ser analisada.</p>
<p>Precificação correta sustenta o negócio.</p>
<p>Revisão periódica é necessária.</p>
<p>ERP ajuda no cálculo.</p>
<p>Preço errado compromete o futuro.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Precificação', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 6,
            ],

            [
                'titulo' => 'Depender de poucos clientes',
                'descricao' => 'Risco alto para microempresas.',
                'conteudo' => '<h2>Concentração de clientes</h2>
<p>Poucos clientes aumentam risco.</p>
<p>Perda de um cliente impacta muito.</p>
<p>Receita fica instável.</p>
<p>Diversificar clientes é essencial.</p>
<p>Marketing ajuda na captação.</p>
<p>Relacionamento fortalece vendas.</p>
<p>Base diversificada traz segurança.</p>
<p>Planejamento reduz dependência.</p>
<p>ERP ajuda no controle de clientes.</p>
<p>Segurança vem da diversidade.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Gestão de clientes', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 7,
            ],

            [
                'titulo' => 'Falta de controle de estoque',
                'descricao' => 'Estoque desorganizado gera prejuízo.',
                'conteudo' => '<h2>Erro no estoque</h2>
<p>Estoque parado consome capital.</p>
<p>Falta de estoque gera perda de vendas.</p>
<p>Desperdício aumenta custos.</p>
<p>Controle evita prejuízo.</p>
<p>Planejamento de compras é essencial.</p>
<p>Giro de estoque melhora o caixa.</p>
<p>ERP facilita o controle.</p>
<p>Relatórios ajudam decisões.</p>
<p>Estoque saudável é estratégico.</p>
<p>Organização gera lucro.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Gestão de estoque', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 8,
            ],

            [
                'titulo' => 'Não analisar indicadores',
                'descricao' => 'Ignorar números compromete decisões.',
                'conteudo' => '<h2>Indicadores ignorados</h2>
<p>Indicadores mostram a realidade.</p>
<p>Sem análise não há gestão.</p>
<p>Lucro, caixa e vendas devem ser acompanhados.</p>
<p>Decisões sem dados geram risco.</p>
<p>Relatórios ajudam no controle.</p>
<p>ERP facilita acompanhamento.</p>
<p>Indicadores mostram tendências.</p>
<p>Analisar evita erros.</p>
<p>Gestão baseada em dados é segura.</p>
<p>Números guiam o negócio.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Indicadores de desempenho', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 9,
            ],

            [
                'titulo' => 'Falta de planejamento',
                'descricao' => 'Trabalhar sem planejamento aumenta riscos.',
                'conteudo' => '<h2>Planejamento empresarial</h2>
<p>Planejamento orienta decisões.</p>
<p>Sem ele o negócio fica perdido.</p>
<p>Objetivos não são claros.</p>
<p>Gastos fogem do controle.</p>
<p>Planejamento reduz incertezas.</p>
<p>Ajuda a definir metas.</p>
<p>Facilita crescimento.</p>
<p>ERP apoia o planejamento.</p>
<p>Planejar é pensar no futuro.</p>
<p>Empresas planejadas sobrevivem mais.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Planejamento empresarial', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 10,
            ],

            [
                'titulo' => 'Resistência à tecnologia',
                'descricao' => 'Não usar tecnologia gera atraso competitivo.',
                'conteudo' => '<h2>Tecnologia no negócio</h2>
<p>Resistir à tecnologia limita crescimento.</p>
<p>Processos manuais geram erros.</p>
<p>ERP organiza informações.</p>
<p>Automação reduz custos.</p>
<p>Tecnologia melhora decisões.</p>
<p>Pequenas empresas também se beneficiam.</p>
<p>Adaptação é necessária.</p>
<p>Inovação traz competitividade.</p>
<p>Negócios digitais crescem mais.</p>
<p>Modernizar é sobreviver.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Tecnologia para empresas', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 11,
            ],

            [
                'titulo' => 'Ignorar capacitação e aprendizado',
                'descricao' => 'Falta de conhecimento aumenta erros.',
                'conteudo' => '<h2>Capacitação empresarial</h2>
<p>Mercado muda constantemente.</p>
<p>Empresários precisam se atualizar.</p>
<p>Ignorar aprendizado gera erros.</p>
<p>Capacitação melhora gestão.</p>
<p>Sebrae oferece apoio.</p>
<p>Conhecimento reduz riscos.</p>
<p>Empresas capacitadas crescem mais.</p>
<p>Aprender evita prejuízos.</p>
<p>Gestão consciente é educativa.</p>
<p>Aprender é investir no negócio.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Capacitação empresarial', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Riscos e Erros Comuns',
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
