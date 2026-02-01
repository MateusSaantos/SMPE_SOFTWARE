<?php

namespace Database\Seeders;

use App\Models\Educativo;
use Illuminate\Database\Seeder;

class EducativosSuaEmpresaSebraeSeeder extends Seeder
{
    public function run(): void
    {
        $dados = [
            // =========================
            // Categoria: SUA EMPRESA
            // Fonte: SEBRAE
            // =========================
            [
                'titulo'    => 'O que é MEI?',
                'descricao' => 'Entenda o que é o Microempreendedor Individual.',
                'conteudo'  => '<h2>O que é MEI?</h2>
<p>O Microempreendedor Individual (MEI) é uma forma simplificada de formalização criada para pequenos negócios.</p>
<p>Segundo o Sebrae, o MEI permite a obtenção de CNPJ, emissão de notas fiscais e acesso a benefícios previdenciários.</p>
<p>O faturamento anual possui limite definido em lei.</p>
<p>O pagamento mensal é feito por meio do DAS, com valor fixo.</p>
<p>O MEI pode contratar um funcionário e deve manter controle financeiro.</p>',
                'links'     => [
                    ['titulo' => 'MEI — Sebrae', 'url' => 'https://www.sebrae.com.br/sites/PortalSebrae/mei'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 1,
            ],
            [
                'titulo'    => 'Quem pode ser MEI?',
                'descricao' => 'Veja quem pode se formalizar como MEI.',
                'conteudo'  => '<h2>Quem pode ser MEI?</h2>
<p>Pode ser MEI quem exerce atividades permitidas e respeita o limite de faturamento.</p>
<p>O Sebrae recomenda consultar a lista oficial de atividades antes da formalização.</p>
<p>Profissões regulamentadas não podem se enquadrar como MEI.</p>
<p>O empreendedor não pode ser sócio de outra empresa.</p>',
                'links'     => [
                    ['titulo' => 'Atividades permitidas ao MEI — Sebrae', 'url' => 'https://www.sebrae.com.br/sites/PortalSebrae/mei/atividades-permitidas'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 2,
            ],
            [
                'titulo'    => 'Diferença entre MEI, ME e EPP',
                'descricao' => 'Conheça os portes empresariais.',
                'conteudo'  => '<h2>MEI, ME e EPP</h2>
<p>As empresas são classificadas conforme faturamento e estrutura jurídica.</p>
<p>MEI é o menor porte, seguido por ME e EPP.</p>
<p>Cada porte possui regras tributárias e obrigações diferentes.</p>
<p>O Sebrae orienta avaliar o crescimento do negócio.</p>',
                'links'     => [
                    ['titulo' => 'Porte de empresas — Sebrae', 'url' => 'https://www.sebrae.com.br/sites/PortalSebrae/artigos/porte-de-empresa'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 3,
            ],
            [
                'titulo'    => 'Como abrir uma empresa',
                'descricao' => 'Passos para formalizar um negócio.',
                'conteudo'  => '<h2>Como abrir uma empresa</h2>
<p>A abertura de empresa envolve planejamento e registros legais.</p>
<p>É necessário definir natureza jurídica, atividade e porte.</p>
<p>O Sebrae oferece orientação gratuita para empreendedores.</p>',
                'links'     => [
                    ['titulo' => 'Como abrir empresa — Sebrae', 'url' => 'https://www.sebrae.com.br/sites/PortalSebrae/artigos/como-abrir-uma-empresa'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 4,
            ],
            [
                'titulo'    => 'O que é plano de negócios?',
                'descricao' => 'Planejamento essencial para empreender.',
                'conteudo'  => '<h2>Plano de negócios</h2>
<p>O plano de negócios descreve objetivos, estratégias e finanças.</p>
<p>Segundo o Sebrae, ele reduz riscos e aumenta chances de sucesso.</p>
<p>Deve ser revisado periodicamente.</p>',
                'links'     => [
                    ['titulo' => 'Plano de Negócios — Sebrae', 'url' => 'https://www.sebrae.com.br/sites/PortalSebrae/artigos/plano-de-negocio'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 5,
            ],
            [
                'titulo'    => 'Controle financeiro do negócio',
                'descricao' => 'A base da saúde financeira da empresa.',
                'conteudo'  => '<h2>Controle financeiro</h2>
<p>Controlar entradas e saídas é essencial para sobrevivência do negócio.</p>
<p>O Sebrae destaca que falta de controle é causa comum de falência.</p>
<p>Utilize ferramentas simples e registre tudo.</p>',
                'links'     => [
                    ['titulo' => 'Gestão financeira — Sebrae', 'url' => 'https://www.sebrae.com.br/sites/PortalSebrae/artigos/gestao-financeira'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 6,
            ],
            [
                'titulo'    => 'O que é fluxo de caixa?',
                'descricao' => 'Entenda como controlar entradas e saídas.',
                'conteudo'  => '<h2>Fluxo de caixa</h2>
<p>Fluxo de caixa mostra movimentação financeira diária.</p>
<p>Ajuda a prever falta ou sobra de recursos.</p>
<p>O Sebrae recomenda atualização constante.</p>',
                'links'     => [
                    ['titulo' => 'Fluxo de caixa — Sebrae', 'url' => 'https://www.sebrae.com.br/sites/PortalSebrae/artigos/fluxo-de-caixa'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 7,
            ],
            [
                'titulo'    => 'O que é capital de giro?',
                'descricao' => 'Recursos para manter a empresa funcionando.',
                'conteudo'  => '<h2>Capital de giro</h2>
<p>Capital de giro garante funcionamento do negócio.</p>
<p>Cobre despesas operacionais do dia a dia.</p>
<p>O Sebrae recomenda planejamento para evitar endividamento.</p>',
                'links'     => [
                    ['titulo' => 'Capital de giro — Sebrae', 'url' => 'https://www.sebrae.com.br/sites/PortalSebrae/artigos/capital-de-giro'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 8,
            ],
            [
                'titulo'    => 'Separação de contas PF e PJ',
                'descricao' => 'Evite misturar finanças pessoais e empresariais.',
                'conteudo'  => '<h2>Separação PF e PJ</h2>
<p>Misturar contas compromete o controle financeiro.</p>
<p>O Sebrae orienta pró-labore definido.</p>
<p>Tenha conta bancária empresarial.</p>',
                'links'     => [
                    ['titulo' => 'Separar contas — Sebrae', 'url' => 'https://www.sebrae.com.br/sites/PortalSebrae/artigos/separacao-financeira'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 9,
            ],
            [
                'titulo'    => 'Como definir o preço de venda',
                'descricao' => 'Formação correta do preço.',
                'conteudo'  => '<h2>Preço de venda</h2>
<p>Preço deve cobrir custos e gerar lucro.</p>
<p>Considere despesas fixas e variáveis.</p>
<p>O Sebrae recomenda análise de mercado.</p>',
                'links'     => [
                    ['titulo' => 'Preço de venda — Sebrae', 'url' => 'https://www.sebrae.com.br/sites/PortalSebrae/artigos/preco-de-venda'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 10,
            ],

        ];

        foreach ($dados as $d) {
            Educativo::create($d);
        }
    }
}
