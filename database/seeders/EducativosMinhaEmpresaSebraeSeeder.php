<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Educativo;

class EducativosMinhaEmpresaSebraeSeeder extends Seeder
{
    public function run(): void
    {
        $educativos = [
            [
                'titulo' => 'O que é o Sebrae e como ele pode ajudar sua empresa',
                'descricao' => 'Conheça o Sebrae e os principais serviços oferecidos aos empreendedores.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae']
            ],
            [
                'titulo' => 'Como abrir uma empresa com apoio do Sebrae',
                'descricao' => 'Veja como o Sebrae auxilia no processo de abertura do negócio.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/abrir-empresa']
            ],
            [
                'titulo' => 'Cursos gratuitos do Sebrae',
                'descricao' => 'Aprenda sobre gestão, finanças e vendas com cursos online do Sebrae.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/cursosonline']
            ],
            [
                'titulo' => 'Consultorias empresariais do Sebrae',
                'descricao' => 'Saiba como funcionam as consultorias oferecidas pelo Sebrae.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/consultoria']
            ],
            [
                'titulo' => 'Sebrae para MEI',
                'descricao' => 'Conheça os serviços específicos para o Microempreendedor Individual.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/mei']
            ],
            [
                'titulo' => 'Ferramentas de gestão do Sebrae',
                'descricao' => 'Use planilhas, simuladores e ferramentas gratuitas do Sebrae.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/ferramentas']
            ],
            [
                'titulo' => 'Planejamento do negócio com apoio do Sebrae',
                'descricao' => 'Aprenda a planejar sua empresa com métodos do Sebrae.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/planejamento']
            ],
            [
                'titulo' => 'Sebrae e inovação',
                'descricao' => 'Veja como o Sebrae apoia inovação e transformação digital.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/inovacao']
            ],
            [
                'titulo' => 'Sebrae e acesso a crédito',
                'descricao' => 'Entenda como o Sebrae facilita o acesso a crédito para empresas.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/credito']
            ],
            [
                'titulo' => 'Empretec: programa do Sebrae',
                'descricao' => 'Conheça o Empretec e o desenvolvimento do comportamento empreendedor.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/empretec']
            ],

            // ===== 10 restantes =====
            [
                'titulo' => 'Sebrae e formalização de empresas',
                'descricao' => 'Entenda como o Sebrae ajuda na formalização do negócio.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/formalizacao']
            ],
            [
                'titulo' => 'Atendimento e consultoria online do Sebrae',
                'descricao' => 'Saiba como falar com especialistas do Sebrae.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/atendimento']
            ],
            [
                'titulo' => 'Eventos e capacitações do Sebrae',
                'descricao' => 'Participe de eventos, palestras e capacitações.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/eventos']
            ],
            [
                'titulo' => 'Sebrae e gestão financeira',
                'descricao' => 'Aprenda a organizar as finanças da empresa.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/financas']
            ],
            [
                'titulo' => 'Sebrae e marketing digital',
                'descricao' => 'Veja como divulgar sua empresa no ambiente digital.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/marketing-digital']
            ],
            [
                'titulo' => 'Gestão de pessoas com apoio do Sebrae',
                'descricao' => 'Boas práticas para contratar e gerir equipes.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/pessoas']
            ],
            [
                'titulo' => 'Sebrae e vendas',
                'descricao' => 'Aprenda técnicas de vendas e negociação.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/vendas']
            ],
            [
                'titulo' => 'Sebrae e planejamento estratégico',
                'descricao' => 'Use estratégias para crescer de forma sustentável.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/estrategia']
            ],
            [
                'titulo' => 'Sebrae e gestão de riscos',
                'descricao' => 'Aprenda a identificar e reduzir riscos no negócio.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae/riscos']
            ],
            [
                'titulo' => 'Sebrae como parceiro do empreendedor',
                'descricao' => 'Veja como usar o Sebrae continuamente no crescimento da empresa.',
                'categorias' => 'Minha Empresa e o Sebrae',
                'links' => ['https://www.sebrae.com.br/sites/PortalSebrae']
            ],
        ];

        foreach ($educativos as $educativo) {
            Educativo::create($educativo);
        }
    }
}
