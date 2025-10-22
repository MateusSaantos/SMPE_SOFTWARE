<?php

namespace Database\Seeders;

use App\Models\Educativo;
use Illuminate\Database\Seeder;

class EducativosSeeder extends Seeder
{
    public function run(): void
    {
        $dados = [
            // =========================
            // Categoria: SUA EMPRESA
            // =========================
            [
                'titulo'    => 'O que é CNPJ?',
                'descricao' => 'Entenda o que é CNPJ, quem precisa ter e para que serve.',
                'conteudo'  => '<h2>O que é CNPJ?</h2>
<p>O CNPJ (Cadastro Nacional da Pessoa Jurídica) é o registro que identifica formalmente uma empresa perante a Receita Federal do Brasil.</p>
<p>Ele funciona como o CPF das pessoas físicas, mas para empresas: contém informações como razão social, endereço, natureza jurídica, e atividades econômicas (CNAE).</p>
<p>Ter um CNPJ é obrigatório para quem pretende constituir uma pessoa jurídica, emitir notas fiscais, contratar empregados ou participar de licitações.</p>
<p>O CNPJ também é exigido para abertura de conta bancária empresarial, obtenção de crédito e relacionamento com fornecedores e clientes.</p>
<p>Os dados do CNPJ permitem a verificação da regularidade fiscal da empresa e a identificação de sócios e administradores registrados.</p>
<p>Existem diferentes tipos de inscrição — por exemplo matriz e filiais — e o CNPJ principal identifica a matriz da empresa.</p>
<p>A Receita Federal mantém serviços de consulta e atualização do CNPJ, inclusive documentação necessária para inscrições, baixas, alterações e regularizações.</p>
<p>Empresas optantes do Simples Nacional, Lucro Presumido ou Lucro Real continuam utilizando o CNPJ; o regime tributário é informação distinta relacionada ao CNPJ.</p>
<p>Ao contratar contabilidade, a contabilidade usa o CNPJ para registrar obrigações fiscais e trabalhistas corretas.</p>
<p>Manter os dados do CNPJ atualizados evita problemas com fiscalizações, multas e impossibilidade de emissão de documentos fiscais.</p>',
                'links'     => [
                    ['titulo' => 'Receita Federal — Consulta CNPJ', 'url' => 'https://www.gov.br/receitafederal/pt-br/assuntos/orientacao-tributaria/cadastros/cnpj'],
                    ['titulo' => 'Guia de formalização de empresas (Portal Gov)', 'url' => 'https://www.gov.br/pt-br/servicos/abrir-empresa'],
                    ['titulo' => 'Orientações para alteração e baixa de CNPJ', 'url' => 'https://www.gov.br/receitafederal/pt-br/assuntos/orientacao-tributaria/cadastros/cnpj/alteracao-e-baixa'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 1,
            ],
            [
                'titulo'    => 'Como identificar meu regime?',
                'descricao' => 'Descubra se sua empresa está no Simples, Lucro Presumido ou Lucro Real.',
                'conteudo'  => '<h2>Como identificar meu regime tributário?</h2>
<p>O regime tributário de uma empresa define como serão calculados e recolhidos os tributos federais, estaduais e municipais.</p>
<p>Os regimes mais comuns no Brasil são: Simples Nacional, Lucro Presumido e Lucro Real. A escolha depende de faturamento, atividade e planejamento tributário.</p>
<p>O Simples Nacional é um regime simplificado para micro e pequenas empresas com faixas de faturamento específicas e recolhimento unificado de tributos.</p>
<p>O Lucro Presumido utiliza uma base de cálculo estimada para IRPJ e CSLL, com percentuais variáveis conforme o setor de atividade.</p>
<p>O Lucro Real exige apuração contábil do lucro efetivo e costuma ser obrigatório para empresas com faturamento muito alto ou atividades específicas.</p>
<p>Para identificar o regime da empresa, verifique o enquadramento no portal da Receita, o contrato social, e os registros na contabilidade da empresa.</p>
<p>Converse com seu contador — ele fará simulações e verificará vantagens e desvantagens de cada regime segundo sua operação.</p>
<p>Mude de regime quando for vantajoso e permitido pela legislação — muitas mudanças têm prazos e regras específicas de vencimento fiscal.</p>
<p>Fique atento a obrigações acessórias distintas por regime, como declarações, livros e apurações mensais/anuais.</p>
<p>Manter clareza sobre o regime evita pagamentos indevidos e problemas com fiscalização; a contabilidade deve ser informada de qualquer alteração.</p>',
                'links'     => [
                    ['titulo' => 'Portal do Simples Nacional', 'url' => 'https://www8.receita.fazenda.gov.br/SimplesNacional/'],
                    ['titulo' => 'Perguntas frequentes sobre regimes tributários', 'url' => 'https://www.gov.br/receitafederal/pt-br'],
                    ['titulo' => 'Comparativo entre regimes (artigo prático)', 'url' => 'https://example.com/comparativo-regimes'], // substitua por link real se desejar
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 2,
            ],
            [
                'titulo'    => 'Como saber os benefícios do meu regime?',
                'descricao' => 'Entenda benefícios e limitações do seu regime tributário.',
                'conteudo'  => '<h2>Benefícios e limitações do regime tributário</h2>
<p>Cada regime tributário oferece vantagens e desvantagens que impactam fluxo de caixa, carga tributária e obrigações burocráticas.</p>
<p>No Simples Nacional, a principal vantagem é o recolhimento unificado e alíquotas favorecidas para micro e pequenas empresas.</p>
<p>Por outro lado, o Simples pode limitar a possibilidade de recuperar créditos fiscais em certas operações e tem limites de faturamento.</p>
<p>No Lucro Presumido, empresas com margens maiores podem se beneficiar da presunção, mas há regras rígidas quanto a apuração.</p>
<p>O Lucro Real permite aproveitar custos e despesas na apuração do resultado, podendo reduzir tributos em períodos de baixa lucratividade.</p>
<p>Além das alíquotas, é preciso analisar obrigações acessórias, como SPED, EFD, DCTF e declarações estaduais/municipais que variam por regime.</p>
<p>Aspectos setoriais — como indústria, comércio e serviços — alteram a equação: alíquotas e presunções diferem entre setores.</p>
<p>Planejamento tributário e projeções de faturamento são ferramentas essenciais para decidir se migrar de regime é vantajoso.</p>
<p>Consulte seu contador para simulações históricas e projeções futuras: o melhor regime muda conforme crescimento, margem e investimentos.</p>
<p>Além disso, normas e benefícios fiscais estaduais ou municipais podem influenciar a escolha — verifique incentivos locais antes de decidir.</p>',
                'links'     => [
                    ['titulo' => 'Guia comparativo de regimes (referência)', 'url' => 'https://www.gov.br/receitafederal/pt-br/assuntos/orientacao-tributaria'],
                    ['titulo' => 'Simulações tributárias - material explicativo', 'url' => 'https://example.com/simulacoes-tributarias'],
                    ['titulo' => 'Entenda as obrigações acessórias por regime', 'url' => 'https://example.com/obrigacoes-acessorias'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 3,
            ],
            [
                'titulo'    => 'Quais as tributações do meu regime?',
                'descricao' => 'Mapa de tributos por regime: ICMS, ISS, PIS/COFINS, IRPJ, CSLL...',
                'conteudo'  => '<h2>Tributação por regime: quais tributos incidem?</h2>
<p>Os principais tributos que impactam empresas no Brasil são: IRPJ, CSLL, PIS, COFINS, ICMS, ISS, IPI e contribuições previdenciárias.</p>
<p>No Simples Nacional, muitos desses tributos são reunidos em uma guia única (DAS), com alíquotas que variam conforme a faixa de receita e anexos.</p>
<p>Empresas no Lucro Presumido devem calcular IRPJ e CSLL sobre a base presumida; PIS/COFINS podem ser cumulativos ou não, de acordo com o regime de apuração.</p>
<p>O Lucro Real exige apuração contábil do lucro para base de IRPJ/CSLL; PIS/COFINS e tributos federais seguem suas regras específicas.</p>
<p>ICMS é um tributo estadual que incide sobre circulação de mercadorias e serviços de transporte/intermediação; sua alíquota varia por estado e produto.</p>
<p>ISS é um tributo municipal aplicado a serviços; as alíquotas e regras aplicáveis dependem do município e da natureza do serviço prestado.</p>
<p>Além das alíquotas, existem regimes especiais, substituição tributária e exceções setoriais que alteram a forma de cobrança do tributo.</p>
<p>A correta classificação fiscal do produto (NCM) e a escrituração fiscal são essenciais para evitar autuações e recolhimentos indevidos.</p>
<p>Para entender o impacto total, faça simulações por competência, incluindo encargos trabalhistas e custos indiretos associados às obrigações fiscais.</p>
<p>Busque orientação contábil e legal quando houver dúvidas sobre enquadramento, incentivos fiscais e planejamento para redução legal da carga tributária.</p>',
                'links'     => [
                    ['titulo' => 'Legislação — Tributos Federais (Planalto)', 'url' => 'https://www.planalto.gov.br/'],
                    ['titulo' => 'Manual de ICMS por estado', 'url' => 'https://example.com/manual-icms-estados'],
                    ['titulo' => 'Orientações sobre PIS/COFINS', 'url' => 'https://www.gov.br/receitafederal/pt-br/assuntos/tributos/pis-cofins'],
                ],
                'categorias'=> 'Sua Empresa',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 4,
            ],

            // =========================
            // Categoria: PRODUTOS
            // =========================
            [
                'titulo'    => 'O que é um produto?',
                'descricao' => 'Definições de produto, SKU, unidade de medida e cadastro básico.',
                'conteudo'  => '<h2>O que é um produto e como cadastrá-lo corretamente?</h2>
<p>Produto é qualquer bem ou serviço ofertado para venda por uma empresa; para fins fiscais e de gestão, é essencial um cadastro completo.</p>
<p>No cadastro básico do produto devem constar: descrição clara, SKU (identificador interno), NCM, unidade de medida, peso e dimensões quando aplicável.</p>
<p>O NCM (Nomenclatura Comum do Mercosul) é decisivo para determinar tributações como ICMS, IPI e regras de importação/exportação.</p>
<p>Defina panorama de estoques: controle por lote, número de série, validade e regras de perecibilidade quando aplicável.</p>
<p>Estruture categorias internas e atributos (cor, tamanho, material) para facilitar buscas, filtros e integração com marketplaces.</p>
<p>Registre preços: preço de custo, preço de venda e margem desejada; mantenha histórico de alterações para contabilidade e análises.</p>
<p>Integre cadastro com cadastro de fornecedores para rastreabilidade de origem, prazos de reposição e condições comerciais.</p>
<p>Documente regras de precificação, promoções e tributação aplicável ao produto para evitar problemas na emissão de nota fiscal.</p>
<p>Teste a importação/integração do cadastro com sistemas fiscais e plataformas de e-commerce antes de publicar para venda.</p>
<p>Manter o cadastro atualizado reduz erros em faturamento, logística e atendimento ao cliente, além de melhorar a governança do negócio.</p>',
                'links'     => [
                    ['titulo' => 'NCM — Consulta Tabela (Receita)', 'url' => 'https://www.gov.br/receitafederal/pt-br/assuntos/ncm'],
                    ['titulo' => 'Boas práticas de cadastro de produtos', 'url' => 'https://example.com/boas-praticas-cadastro'],
                    ['titulo' => 'Controle de estoque e rastreabilidade', 'url' => 'https://example.com/estoque-rastreabilidade'],
                ],
                'categorias'=> 'Produtos',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 5,
            ],
            [
                'titulo'    => 'Por que meu produto tem tributação?',
                'descricao' => 'Entenda NCM, origem, CST, e como isso influencia impostos.',
                'conteudo'  => '<h2>Por que produtos são tributados e quais fatores influenciam?</h2>
<p>A tributação aplicada a um produto depende fundamentalmente de sua classificação fiscal (NCM), origem (nacional ou importado) e do estado onde ocorre a operação.</p>
<p>O NCM define a base para cobrança de tributos como IPI (quando aplicável) e influencia alíquotas internas de ICMS e regimes de substituição tributária.</p>
<p>A origem do produto (nacional, importado, com conteúdo de importação) pode alterar a incidência de tributos e exigir regimes específicos de declaração.</p>
<p>O CST (Código de Situação Tributária) e o CSOSN (para Simples Nacional) determinam como PIS/COFINS e ICMS serão recolhidos.</p>
<p>Operações interestaduais e operações com substituição tributária têm regras próprias que mudam como o imposto é repassado entre contribuintes.</p>
<p>Alguns produtos têm benefícios fiscais ou isenções previstas por legislação estadual ou federal, dependendo da política local e do uso final do bem.</p>
<p>Impostos indiretos e tributos incidentes sobre circulação e serviços fazem parte do preço final e devem ser considerados em planejamento de custos.</p>
<p>Erros na classificação fiscal podem levar a autuações, recolhimentos retroativos e multas — por isso a importância do suporte contábil e fiscal.</p>
<p>Para operações de importação, tributos aduaneiros, tarifas e regimes especiais aumentam a complexidade fiscal do produto.</p>
<p>Recomenda-se realizar análise tributária por produto ou família de produtos antes de precificar ou vender em novos mercados.</p>',
                'links'     => [
                    ['titulo' => 'Portal da NFe — Notas Técnicas', 'url' => 'https://www.nfe.fazenda.gov.br/portal/'],
                    ['titulo' => 'Classificação fiscal (NCM) — guia prático', 'url' => 'https://example.com/classificacao-ncm'],
                    ['titulo' => 'Substituição tributária e ICMS', 'url' => 'https://example.com/substituicao-tributaria'],
                ],
                'categorias'=> 'Produtos',
                'visivel'   => true,
                'visitado'  => false,
                'status'    => 'publicado',
                'ordem'     => 6,
            ],

            // você pode adicionar mais itens abaixo se necessário...
        ];

        foreach ($dados as $d) {
            Educativo::create($d);
        }
    }
}
