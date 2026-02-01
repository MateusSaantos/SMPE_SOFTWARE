<?php

namespace Database\Seeders;

use App\Models\Educativo;
use Illuminate\Database\Seeder;

class EducativosTecnologiaSeeder extends Seeder
{
    public function run(): void
    {
        $dados = [

            [
                'titulo' => 'O papel da tecnologia na empresa',
                'descricao' => 'Entenda como a tecnologia apoia o crescimento do negócio.',
                'conteudo' => '<h2>Tecnologia e gestão empresarial</h2>
<p>A tecnologia é uma aliada estratégica para micro e pequenas empresas.</p>
<p>Ela permite controle, organização e tomada de decisões baseadas em dados.</p>
<p>Sistemas digitais reduzem erros manuais.</p>
<p>Automação economiza tempo e dinheiro.</p>
<p>Empresas que usam tecnologia crescem com mais segurança.</p>
<p>A tecnologia melhora a comunicação interna.</p>
<p>Facilita o relacionamento com clientes e fornecedores.</p>
<p>Mesmo negócios pequenos podem se beneficiar.</p>
<p>O uso correto gera vantagem competitiva.</p>
<p>Tecnologia não é custo, é investimento.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Tecnologia nos negócios', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Tecnologia e Sua Empresa',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 1,
            ],

            [
                'titulo' => 'O que é um sistema de gestão (ERP)?',
                'descricao' => 'Conheça o conceito de ERP e seus benefícios.',
                'conteudo' => '<h2>Sistema de gestão empresarial</h2>
<p>ERP é um sistema que integra informações da empresa.</p>
<p>Ele centraliza vendas, estoque, financeiro e clientes.</p>
<p>Evita retrabalho e duplicidade de dados.</p>
<p>Facilita o controle do negócio.</p>
<p>Ajuda na tomada de decisão.</p>
<p>ERPs são adaptáveis a pequenos negócios.</p>
<p>Organizam processos internos.</p>
<p>Melhoram a produtividade.</p>
<p>Reduzem erros operacionais.</p>
<p>ERP é base para crescimento estruturado.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — ERP para pequenos negócios', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Tecnologia e Sua Empresa',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 2,
            ],

            [
                'titulo' => 'Automação de processos',
                'descricao' => 'Como automatizar tarefas do dia a dia.',
                'conteudo' => '<h2>Automação de processos</h2>
<p>Automação é o uso da tecnologia para executar tarefas repetitivas.</p>
<p>Reduz falhas humanas.</p>
<p>Aumenta a produtividade.</p>
<p>Libera tempo para atividades estratégicas.</p>
<p>Exemplos incluem emissão de notas e controle financeiro.</p>
<p>Automação não elimina empregos.</p>
<p>Ela melhora a eficiência.</p>
<p>Processos automatizados são mais rápidos.</p>
<p>Negócios pequenos também podem automatizar.</p>
<p>Automação gera competitividade.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Automação', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Tecnologia e Sua Empresa',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 3,
            ],

            [
                'titulo' => 'Controle de dados da empresa',
                'descricao' => 'Entenda a importância dos dados.',
                'conteudo' => '<h2>Gestão de dados empresariais</h2>
<p>Dados são informações estratégicas.</p>
<p>Incluem vendas, clientes e custos.</p>
<p>Dados organizados geram relatórios.</p>
<p>Relatórios auxiliam decisões.</p>
<p>Sem dados, decisões são baseadas em achismo.</p>
<p>Sistemas facilitam armazenamento.</p>
<p>Dados precisam ser confiáveis.</p>
<p>Atualização constante é essencial.</p>
<p>Backup evita perda de informações.</p>
<p>Dados são ativos da empresa.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Gestão de dados', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Tecnologia e Sua Empresa',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 4,
            ],

            [
                'titulo' => 'Segurança da informação',
                'descricao' => 'Proteja os dados do seu negócio.',
                'conteudo' => '<h2>Segurança da informação</h2>
<p>Segurança da informação protege dados da empresa.</p>
<p>Inclui senhas, backups e acessos.</p>
<p>Vazamento de dados gera prejuízos.</p>
<p>Use senhas fortes.</p>
<p>Controle quem acessa o sistema.</p>
<p>Faça backups frequentes.</p>
<p>Atualize sistemas regularmente.</p>
<p>Treine usuários.</p>
<p>Segurança evita fraudes.</p>
<p>É responsabilidade do empreendedor.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Segurança digital', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Tecnologia e Sua Empresa',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 5,
            ],

            [
                'titulo' => 'Backup e recuperação de dados',
                'descricao' => 'Como evitar perda de informações.',
                'conteudo' => '<h2>Backup de dados</h2>
<p>Backup é a cópia de segurança dos dados.</p>
<p>Evita perda por falhas ou ataques.</p>
<p>Deve ser feito regularmente.</p>
<p>Pode ser local ou em nuvem.</p>
<p>Testar a recuperação é essencial.</p>
<p>Backup protege a continuidade do negócio.</p>
<p>Dados financeiros exigem atenção.</p>
<p>Automatizar backups é recomendado.</p>
<p>Empresas pequenas também precisam.</p>
<p>Backup garante tranquilidade.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Backup de dados', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Tecnologia e Sua Empresa',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 6,
            ],

            [
                'titulo' => 'Uso da tecnologia no controle financeiro',
                'descricao' => 'Tecnologia aplicada às finanças.',
                'conteudo' => '<h2>Tecnologia no financeiro</h2>
<p>Sistemas ajudam no controle financeiro.</p>
<p>Facilitam registro de entradas e saídas.</p>
<p>Geram relatórios automáticos.</p>
<p>Ajudam no fluxo de caixa.</p>
<p>Reduzem erros manuais.</p>
<p>Integração com vendas é essencial.</p>
<p>Planejamento financeiro melhora.</p>
<p>Controle evita prejuízos.</p>
<p>ERP é aliado do financeiro.</p>
<p>Finanças organizadas garantem crescimento.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Controle financeiro', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Tecnologia e Sua Empresa',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 7,
            ],

            [
                'titulo' => 'Tecnologia no controle de estoque',
                'descricao' => 'Como sistemas ajudam no estoque.',
                'conteudo' => '<h2>Controle de estoque com tecnologia</h2>
<p>O estoque precisa de controle preciso.</p>
<p>Sistemas evitam faltas e excessos.</p>
<p>Integração com vendas é fundamental.</p>
<p>Reduz perdas e desperdícios.</p>
<p>Ajuda no planejamento de compras.</p>
<p>Estoque organizado melhora o atendimento.</p>
<p>Relatórios facilitam decisões.</p>
<p>Controle manual gera erros.</p>
<p>ERP automatiza o controle.</p>
<p>Estoque saudável aumenta lucro.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Controle de estoque', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Tecnologia e Sua Empresa',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 8,
            ],

            [
                'titulo' => 'Tecnologia e vendas',
                'descricao' => 'Apoio tecnológico no processo de vendas.',
                'conteudo' => '<h2>Tecnologia aplicada às vendas</h2>
<p>A tecnologia organiza o processo de vendas.</p>
<p>Registra pedidos e clientes.</p>
<p>Facilita acompanhamento.</p>
<p>Integra com estoque e financeiro.</p>
<p>Reduz erros de digitação.</p>
<p>Melhora a experiência do cliente.</p>
<p>Relatórios mostram desempenho.</p>
<p>Ajuda a definir estratégias.</p>
<p>ERP é aliado das vendas.</p>
<p>Vendas organizadas vendem mais.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Tecnologia em vendas', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Tecnologia e Sua Empresa',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 9,
            ],

            [
                'titulo' => 'Relatórios gerenciais',
                'descricao' => 'Use relatórios para tomar decisões.',
                'conteudo' => '<h2>Relatórios gerenciais</h2>
<p>Relatórios transformam dados em informação.</p>
<p>Mostram resultados reais.</p>
<p>Ajudam no planejamento.</p>
<p>Indicadores orientam decisões.</p>
<p>Relatórios financeiros são essenciais.</p>
<p>Relatórios de vendas mostram desempenho.</p>
<p>Sistemas geram relatórios automáticos.</p>
<p>Visualização facilita entendimento.</p>
<p>Analisar relatórios evita erros.</p>
<p>Relatórios apoiam o crescimento.</p>',
                'links' => [
                    ['titulo' => 'Sebrae — Relatórios', 'url' => 'https://www.sebrae.com.br'],
                ],
                'categorias' => 'Tecnologia e Sua Empresa',
                'visivel' => true,
                'visitado' => false,
                'status' => 'publicado',
                'ordem' => 10,
            ],

            // Itens 11 a 25: LGPD, nuvem, integração, sistemas online, escalabilidade,
            // indicadores (KPIs), erros comuns, tecnologia barata, digitalização,
            // futuro da tecnologia, inovação, cultura digital, suporte técnico,
            // escolha de sistemas, tecnologia como estratégia
            // (posso continuar se quiser já colar tudo no próximo envio)

        ];

        foreach ($dados as $dado) {
            Educativo::create($dado);
        }
    }
}
