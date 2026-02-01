<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Educativo;

class EducativosProdutosSebraeSeeder extends Seeder
{
    public function run(): void
    {
        $educativos = [
            [
                'titulo' => 'Como definir um produto vencedor',
                'descricao' => 'Aprenda a identificar oportunidades e criar produtos com alto potencial de mercado.',
                'categorias' => 'Produtos',
                'links' => [
                    'https://www.sebrae.com.br/sites/PortalSebrae/artigos/como-criar-um-produto-de-sucesso'
                ]
            ],
            [
                'titulo' => 'Validação de produtos no mercado',
                'descricao' => 'Entenda como validar sua ideia antes de investir tempo e dinheiro.',
                'categorias' => 'Produtos',
                'links' => [
                    'https://www.sebrae.com.br/sites/PortalSebrae/artigos/como-validar-uma-ideia-de-negocio'
                ]
            ],
            [
                'titulo' => 'Ciclo de vida do produto',
                'descricao' => 'Conheça as fases de um produto desde o lançamento até a retirada do mercado.',
                'categorias' => 'Produtos',
                'links' => [
                    'https://www.sebrae.com.br/sites/PortalSebrae/artigos/ciclo-de-vida-do-produto'
                ]
            ],
            [
                'titulo' => 'Precificação de produtos',
                'descricao' => 'Aprenda a formar preços de maneira correta e competitiva.',
                'categorias' => 'Produtos',
                'links' => [
                    'https://www.sebrae.com.br/sites/PortalSebrae/artigos/como-definir-o-preco-de-venda'
                ]
            ],
            [
                'titulo' => 'Análise de custos do produto',
                'descricao' => 'Saiba calcular custos diretos e indiretos do seu produto.',
                'categorias' => 'Produtos',
                'links' => [
                    'https://www.sebrae.com.br/sites/PortalSebrae/artigos/controle-de-custos'
                ]
            ],
            [
                'titulo' => 'Design de produto e experiência do cliente',
                'descricao' => 'Veja como o design influencia a decisão de compra.',
                'categorias' => 'Produtos',
                'links' => [
                    'https://www.sebrae.com.br/sites/PortalSebrae/artigos/design-thinking'
                ]
            ],
            [
                'titulo' => 'Embalagem como estratégia de vendas',
                'descricao' => 'Entenda a importância da embalagem para o sucesso do produto.',
                'categorias' => 'Produtos',
                'links' => [
                    'https://www.sebrae.com.br/sites/PortalSebrae/artigos/importancia-da-embalagem'
                ]
            ],
            [
                'titulo' => 'Diferenciação de produtos',
                'descricao' => 'Descubra como destacar seu produto frente à concorrência.',
                'categorias' => 'Produtos',
                'links' => [
                    'https://www.sebrae.com.br/sites/PortalSebrae/artigos/diferenciacao-de-produtos'
                ]
            ],
            [
                'titulo' => 'Portfólio de produtos',
                'descricao' => 'Saiba como organizar e expandir seu mix de produtos.',
                'categorias' => 'Produtos',
                'links' => [
                    'https://www.sebrae.com.br/sites/PortalSebrae/artigos/gestao-do-mix-de-produtos'
                ]
            ],
            [
                'titulo' => 'Gestão de estoque eficiente',
                'descricao' => 'Evite perdas e falta de produtos com uma boa gestão de estoque.',
                'categorias' => 'Produtos',
                'links' => [
                    'https://www.sebrae.com.br/sites/PortalSebrae/artigos/controle-de-estoque'
                ]
            ],

            // ====== 15 restantes ======
            [
                'titulo' => 'Produtos mínimos viáveis (MVP)',
                'descricao' => 'Entenda como lançar um produto mínimo para testar o mercado.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/mvp-produto-minimo-viavel']
            ],
            [
                'titulo' => 'Inovação em produtos',
                'descricao' => 'Veja como inovar e se manter competitivo.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/inovacao-em-produtos']
            ],
            [
                'titulo' => 'Qualidade do produto',
                'descricao' => 'Garanta a qualidade e aumente a satisfação do cliente.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/gestao-da-qualidade']
            ],
            [
                'titulo' => 'Pesquisa de satisfação do produto',
                'descricao' => 'Use feedbacks para melhorar seus produtos.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/pesquisa-de-satisfacao']
            ],
            [
                'titulo' => 'Produtos digitais',
                'descricao' => 'Entenda como criar e vender produtos digitais.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/produtos-digitais']
            ],
            [
                'titulo' => 'Gestão de fornecedores',
                'descricao' => 'Escolha bons fornecedores para garantir bons produtos.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/gestao-de-fornecedores']
            ],
            [
                'titulo' => 'Padronização de produtos',
                'descricao' => 'Garanta consistência e qualidade.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/padronizacao']
            ],
            [
                'titulo' => 'Escalabilidade de produtos',
                'descricao' => 'Prepare seu produto para crescer junto com o negócio.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/escalabilidade']
            ],
            [
                'titulo' => 'Gestão do lançamento de produtos',
                'descricao' => 'Planeje lançamentos eficientes.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/lancamento-de-produtos']
            ],
            [
                'titulo' => 'Análise da concorrência',
                'descricao' => 'Compare seus produtos com os concorrentes.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/analise-da-concorrencia']
            ],
            [
                'titulo' => 'Linha premium de produtos',
                'descricao' => 'Veja quando vale a pena criar produtos premium.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/produtos-premium']
            ],
            [
                'titulo' => 'Gestão de marcas e produtos',
                'descricao' => 'Alinhe seus produtos à marca.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/gestao-de-marcas']
            ],
            [
                'titulo' => 'Customização de produtos',
                'descricao' => 'Atenda melhor seus clientes com produtos personalizados.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/customizacao']
            ],
            [
                'titulo' => 'Sustentabilidade em produtos',
                'descricao' => 'Crie produtos mais sustentáveis.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/sustentabilidade']
            ],
            [
                'titulo' => 'Gestão de devoluções',
                'descricao' => 'Aprenda a lidar com trocas e devoluções.',
                'categorias' => 'Produtos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/logistica-reversa']
            ],
        ];

        foreach ($educativos as $educativo) {
            Educativo::create($educativo);
        }
    }
}
