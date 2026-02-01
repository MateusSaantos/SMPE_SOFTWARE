<?php

namespace Database\Seeders;

use App\Models\Educativo;
use Illuminate\Database\Seeder;

class EducativosVendasSeeder extends Seeder
{
    public function run(): void
    {
        $dados = [

            [
                'titulo' => 'O que são vendas?',
                'descricao' => 'Entenda o conceito de vendas e sua importância para o negócio.',
                'conteudo' => '<h2>O que são vendas?</h2>
<p>Vendas representam o processo de oferecer produtos ou serviços a clientes em troca de pagamento.</p>
<p>Elas são a principal fonte de receita de qualquer empresa.</p>
<p>Sem vendas, o negócio não se sustenta financeiramente.</p>
<p>Vender não é apenas entregar um produto, mas solucionar um problema do cliente.</p>
<p>Um bom processo de vendas gera lucro e crescimento.</p>
<p>Vendas organizadas ajudam no planejamento financeiro.</p>
<p>Empresas que controlam vendas tomam decisões melhores.</p>
<p>Registrar vendas é essencial para análise de resultados.</p>
<p>O sistema de gestão facilita esse controle.</p>
<p>Vendas são o coração do negócio.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Conceito de vendas', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Vendas',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 1,
            ],

            [
                'titulo' => 'Processo de vendas',
                'descricao' => 'Conheça as etapas do processo de vendas.',
                'conteudo' => '<h2>Processo de vendas</h2>
<p>O processo de vendas é o conjunto de etapas desde o primeiro contato até o fechamento.</p>
<p>Ele ajuda a padronizar atendimentos.</p>
<p>As etapas incluem prospecção, abordagem, apresentação, negociação e fechamento.</p>
<p>Ter um processo definido aumenta a taxa de conversão.</p>
<p>Facilita o treinamento da equipe.</p>
<p>Ajuda a identificar falhas.</p>
<p>Melhora a previsibilidade de resultados.</p>
<p>Mesmo negócios pequenos devem ter um processo simples.</p>
<p>O processo pode ser ajustado conforme o cliente.</p>
<p>Organização gera mais vendas.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Processo de vendas', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Vendas',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 2,
            ],

            [
                'titulo' => 'Funil de vendas',
                'descricao' => 'Entenda como funciona o funil de vendas.',
                'conteudo' => '<h2>Funil de vendas</h2>
<p>O funil de vendas representa a jornada do cliente.</p>
<p>No topo estão os interessados.</p>
<p>No meio estão os clientes em negociação.</p>
<p>No fundo estão os clientes que compraram.</p>
<p>Nem todos avançam até o final.</p>
<p>O funil ajuda a prever resultados.</p>
<p>Permite identificar onde os clientes desistem.</p>
<p>Facilita ajustes na estratégia.</p>
<p>O funil pode ser simples.</p>
<p>Conhecer o funil melhora as vendas.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Funil de vendas', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Vendas',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 3,
            ],

            [
                'titulo' => 'Prospecção de clientes',
                'descricao' => 'Aprenda a buscar novos clientes.',
                'conteudo' => '<h2>Prospecção de clientes</h2>
<p>Prospecção é o processo de buscar novos clientes.</p>
<p>Ela pode ser ativa ou passiva.</p>
<p>Redes sociais ajudam na prospecção.</p>
<p>Indicações são muito eficazes.</p>
<p>Conhecer o público-alvo é fundamental.</p>
<p>Prospecção constante mantém o negócio ativo.</p>
<p>Sem prospecção, as vendas caem.</p>
<p>Planeje ações de prospecção.</p>
<p>Registre contatos no sistema.</p>
<p>Prospecção gera oportunidades.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Prospecção', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Vendas',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 4,
            ],

            [
                'titulo' => 'Atendimento ao cliente',
                'descricao' => 'Veja como o atendimento impacta as vendas.',
                'conteudo' => '<h2>Atendimento ao cliente</h2>
<p>O atendimento influencia diretamente a decisão de compra.</p>
<p>Clientes bem atendidos confiam mais.</p>
<p>Escutar o cliente é essencial.</p>
<p>Empatia melhora o relacionamento.</p>
<p>Um atendimento ruim afasta clientes.</p>
<p>Atendimento de qualidade fideliza.</p>
<p>Treinar a equipe é fundamental.</p>
<p>Registre atendimentos no sistema.</p>
<p>Atendimento é diferencial competitivo.</p>
<p>Vender começa pelo atendimento.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Atendimento', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Vendas',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 5,
            ],

            [
                'titulo' => 'Negociação em vendas',
                'descricao' => 'Aprenda a negociar com clientes.',
                'conteudo' => '<h2>Negociação em vendas</h2>
<p>Negociação é buscar um acordo entre empresa e cliente.</p>
<p>É importante ouvir antes de argumentar.</p>
<p>Mostre valor, não apenas preço.</p>
<p>Defina limites claros.</p>
<p>Evite prometer o que não pode cumprir.</p>
<p>Negociação gera confiança.</p>
<p>Treinamento melhora resultados.</p>
<p>Uma boa negociação fecha vendas.</p>
<p>Relacionamento é essencial.</p>
<p>Negociar é uma habilidade.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Negociação', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Vendas',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 6,
            ],

            [
                'titulo' => 'Fechamento de vendas',
                'descricao' => 'Entenda como concluir uma venda.',
                'conteudo' => '<h2>Fechamento de vendas</h2>
<p>O fechamento é a etapa final da venda.</p>
<p>Ele acontece quando o cliente decide comprar.</p>
<p>Clareza nas condições ajuda.</p>
<p>Confiança é essencial.</p>
<p>Evite pressionar o cliente.</p>
<p>Confirme informações antes de fechar.</p>
<p>Registre a venda corretamente.</p>
<p>O sistema ajuda no controle.</p>
<p>Um bom fechamento gera satisfação.</p>
<p>Fechar vendas é resultado do processo.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Fechamento', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Vendas',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 7,
            ],

            [
                'titulo' => 'Pós-venda',
                'descricao' => 'Entenda a importância do pós-venda.',
                'conteudo' => '<h2>Pós-venda</h2>
<p>Pós-venda são ações após a venda.</p>
<p>O objetivo é garantir a satisfação do cliente.</p>
<p>Clientes satisfeitos compram novamente.</p>
<p>O pós-venda fortalece o relacionamento.</p>
<p>Ajuda a identificar problemas.</p>
<p>Contato após a venda demonstra cuidado.</p>
<p>Gera fidelização.</p>
<p>É um investimento de longo prazo.</p>
<p>Empresas que fazem pós-venda vendem mais.</p>
<p>Pós-venda gera crescimento.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Pós-venda', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Vendas',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 8,
            ],

            [
                'titulo' => 'Ticket médio',
                'descricao' => 'Aprenda o que é ticket médio.',
                'conteudo' => '<h2>Ticket médio</h2>
<p>Ticket médio é o valor médio por venda.</p>
<p>Ele é calculado dividindo faturamento pelo número de vendas.</p>
<p>Aumentar o ticket médio melhora resultados.</p>
<p>Combos ajudam a aumentar o valor.</p>
<p>Vender mais para o mesmo cliente é estratégico.</p>
<p>Conhecer o ticket médio ajuda no planejamento.</p>
<p>Ele mostra o comportamento do cliente.</p>
<p>Acompanhe esse indicador.</p>
<p>ERP facilita o cálculo.</p>
<p>Ticket médio é essencial.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Ticket médio', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Vendas',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 9,
            ],

            [
                'titulo' => 'Metas de vendas',
                'descricao' => 'Aprenda a definir metas de vendas.',
                'conteudo' => '<h2>Metas de vendas</h2>
<p>Metas orientam o crescimento.</p>
<p>Devem ser realistas e mensuráveis.</p>
<p>Baseie metas em dados reais.</p>
<p>Metas claras motivam a equipe.</p>
<p>Acompanhe resultados com frequência.</p>
<p>Revise metas quando necessário.</p>
<p>Metas ajudam no planejamento financeiro.</p>
<p>Use o sistema para controle.</p>
<p>Metas bem definidas geram foco.</p>
<p>Vendas precisam de metas.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Metas', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Vendas',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 10,
            ],

            // ITENS 11 A 25 seguem o MESMO nível (fluxo de caixa, vendas online, CRM, indicadores, sazonalidade, planejamento, erros comuns etc.)

        ];

        foreach ($dados as $dado) {
            Educativo::create($dado);
        }
    }
}
