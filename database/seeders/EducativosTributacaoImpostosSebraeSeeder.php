<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Educativo;

class EducativosTributacaoImpostosSebraeSeeder extends Seeder
{
    public function run(): void
    {
        $educativos = [
            [
                'titulo' => 'Entendendo o sistema tributário brasileiro',
                'descricao' => 'Conheça a estrutura dos impostos no Brasil e como eles impactam sua empresa.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/sistema-tributario-brasileiro']
            ],
            [
                'titulo' => 'Simples Nacional: como funciona',
                'descricao' => 'Entenda as regras, vantagens e limites do Simples Nacional.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/simples-nacional']
            ],
            [
                'titulo' => 'Lucro Presumido ou Lucro Real?',
                'descricao' => 'Saiba escolher o regime tributário mais adequado ao seu negócio.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/regimes-tributarios']
            ],
            [
                'titulo' => 'Principais impostos para empresas',
                'descricao' => 'Conheça ISS, ICMS, IPI, IRPJ, CSLL e outros tributos.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/impostos-para-empresas']
            ],
            [
                'titulo' => 'Carga tributária: como reduzir legalmente',
                'descricao' => 'Veja estratégias legais para pagar menos impostos.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/planejamento-tributario']
            ],
            [
                'titulo' => 'Planejamento tributário',
                'descricao' => 'Organize sua empresa para otimizar tributos e evitar riscos.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/planejamento-tributario-empresarial']
            ],
            [
                'titulo' => 'Impostos sobre vendas',
                'descricao' => 'Entenda a tributação incidente sobre vendas de produtos e serviços.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/impostos-sobre-vendas']
            ],
            [
                'titulo' => 'Nota fiscal: quando e como emitir',
                'descricao' => 'Aprenda a emitir notas fiscais corretamente.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/nota-fiscal']
            ],
            [
                'titulo' => 'Impostos para MEI',
                'descricao' => 'Veja quais impostos o MEI paga e como manter tudo em dia.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/impostos-mei']
            ],
            [
                'titulo' => 'Obrigações acessórias',
                'descricao' => 'Entenda declarações e obrigações além do pagamento de impostos.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/obrigacoes-acessorias']
            ],

            // ===== 15 restantes =====
            [
                'titulo' => 'Impostos federais, estaduais e municipais',
                'descricao' => 'Saiba diferenciar os tributos por esfera governamental.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/tipos-de-impostos']
            ],
            [
                'titulo' => 'Substituição tributária',
                'descricao' => 'Entenda como funciona a substituição tributária do ICMS.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/substituicao-tributaria']
            ],
            [
                'titulo' => 'Impostos sobre folha de pagamento',
                'descricao' => 'Conheça encargos e tributos relacionados a funcionários.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/encargos-trabalhistas']
            ],
            [
                'titulo' => 'Diferença entre imposto, taxa e contribuição',
                'descricao' => 'Entenda os conceitos básicos da tributação.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/imposto-taxa-contribuicao']
            ],
            [
                'titulo' => 'Multas e juros por atraso',
                'descricao' => 'Saiba como evitar e regularizar débitos fiscais.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/multas-e-juros']
            ],
            [
                'titulo' => 'Parcelamento de impostos',
                'descricao' => 'Veja como parcelar débitos tributários.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/parcelamento-debitos']
            ],
            [
                'titulo' => 'Fiscalização e autuação',
                'descricao' => 'Entenda como funciona a fiscalização tributária.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/fiscalizacao-tributaria']
            ],
            [
                'titulo' => 'Impostos no e-commerce',
                'descricao' => 'Conheça os tributos aplicáveis às vendas online.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/impostos-ecommerce']
            ],
            [
                'titulo' => 'Reforma tributária: o que muda',
                'descricao' => 'Entenda os principais pontos da reforma tributária.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/reforma-tributaria']
            ],
            [
                'titulo' => 'Contabilidade e tributos',
                'descricao' => 'A importância da contabilidade no controle de impostos.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/contabilidade-tributaria']
            ],
            [
                'titulo' => 'Impostos na prestação de serviços',
                'descricao' => 'Veja quais impostos incidem sobre serviços.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/impostos-servicos']
            ],
            [
                'titulo' => 'Benefícios fiscais',
                'descricao' => 'Conheça incentivos e benefícios fiscais disponíveis.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/beneficios-fiscais']
            ],
            [
                'titulo' => 'Regularidade fiscal da empresa',
                'descricao' => 'Entenda a importância de manter impostos em dia.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/regularidade-fiscal']
            ],
            [
                'titulo' => 'Impostos e crescimento do negócio',
                'descricao' => 'Como a tributação impacta o crescimento empresarial.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/impacto-dos-impostos']
            ],
            [
                'titulo' => 'Gestão fiscal eficiente',
                'descricao' => 'Boas práticas para controlar impostos e evitar problemas.',
                'categorias' => 'Tributação e Impostos',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/artigos/gestao-fiscal']
            ],
        ];

        foreach ($educativos as $educativo) {
            Educativo::create($educativo);
        }
    }
}
