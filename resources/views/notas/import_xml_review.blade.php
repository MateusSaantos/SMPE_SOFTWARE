@php
  // Resgata o rascunho da sessão
  $draft        = session("import_nfe.$token");

  // Listas auxiliares
  $categorias   = \App\Models\Categoria::orderBy('descricao')->get(['id','descricao']);

  // Fornecedor do XML
  $fornXml      = $draft['fornecedor'] ?? null;
  $cnpjXml      = $fornXml['cnpj'] ?? null;

  // Tenta localizar fornecedor por CNPJ
  $fornecedorEncontrado = null;
  if ($cnpjXml) {
    // Ajuste aqui caso sua PK/coluna seja diferente
    $fornecedorEncontrado = \App\Models\Fornecedor::where('cnpj', $cnpjXml)->first();
  }

  // Sugestões de produto do parser original (mantido se quiser usar)
  $prodSugestoes = $draft['suggestions']['produtos'] ?? [];
@endphp

@if(!$draft)
  <div class="alert alert-warning">A pré-visualização expirou. Reenvie o XML.</div>
@else
  <form method="POST" action="{{ route('notas.import.commit') }}" class="needs-validation" novalidate>
    @csrf
    <input type="hidden" name="token" value="{{ $token }}"/>

    {{-- Resumo da capa --}}
    <div class="card shadow-sm mb-3">
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3">
            <strong>Número/Série:</strong><br>
            {{ $draft['nota']['numero'] }} / {{ $draft['nota']['serie'] ?: '—' }}
          </div>
          <div class="col-md-3">
            <strong>Emissão:</strong><br>
            {{ $draft['nota']['data_emissao'] ? \Carbon\Carbon::parse($draft['nota']['data_emissao'])->format('d/m/Y H:i') : '—' }}
          </div>
          <div class="col-md-4">
            <strong>Chave:</strong><br>
            <span class="text-mono">{{ $draft['nota']['chave'] ?: '—' }}</span>
          </div>
          <div class="col-md-2">
            <strong>Dest. CNPJ:</strong><br>
            <span class="text-mono">{{ $draft['nota']['cnpj_dest'] ?: '—' }}</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Fornecedor (auto: vincula por CNPJ ou prepara criação) --}}
    <div class="card shadow-sm mb-3">
      <div class="card-header d-flex align-items-center gap-2">
        <i class="fa-solid fa-truck-field"></i>
        <strong>Fornecedor</strong>
      </div>
      <div class="card-body">
        @if($fornecedorEncontrado)
          {{-- Vinculado automaticamente --}}
          <div class="alert alert-success d-flex align-items-center gap-2">
            <i class="fa-solid fa-link"></i>
            <div>
              <strong>Fornecedor vinculado automaticamente pelo CNPJ.</strong><br>
              {{ $fornecedorEncontrado->razao_social }} — <span class="text-mono">{{ $fornecedorEncontrado->cnpj }}</span>
            </div>
          </div>
          {{-- Envia o ID/Chave do fornecedor para o backend --}}
          <input type="hidden" name="fornecedor_id" value="{{ $fornecedorEncontrado->cnpj }}">
          <input type="hidden" name="fornecedor_mode" value="link">
        @else
          {{-- Não encontrou: preparar criação automática (sem opção de alternar) --}}
          <div class="alert alert-warning d-flex align-items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
              <strong>Fornecedor não encontrado pelo CNPJ.</strong> Vamos criar automaticamente com os dados do XML.
            </div>
          </div>

          <input type="hidden" name="fornecedor_mode" value="new">

          <div class="row g-2">
            <div class="col-md-4">
              <label class="form-label">CNPJ</label>
              <input type="text" class="form-control text-mono" value="{{ $fornXml['cnpj'] ?? '' }}" disabled>
              <input type="hidden" name="fornecedor_new[cnpj]" value="{{ $fornXml['cnpj'] ?? '' }}">
            </div>
            <div class="col-md-8">
              <label class="form-label">Razão Social</label>
              <input type="text" class="form-control" value="{{ $fornXml['razao'] ?? '' }}" disabled>
              <input type="hidden" name="fornecedor_new[razao_social]" value="{{ $fornXml['razao'] ?? '' }}">
            </div>

            @if(($fornXml['endereco'] ?? null))
              @php $e = $fornXml['endereco']; @endphp
              <div class="col-md-2">
                <label class="form-label">CEP</label>
                <input class="form-control" value="{{ $e['cep'] ?? '' }}" disabled>
                <input type="hidden" name="fornecedor_new[endereco][cep]" value="{{ $e['cep'] ?? '' }}">
              </div>
              <div class="col-md-1">
                <label class="form-label">UF</label>
                <input class="form-control" value="{{ $e['uf'] ?? '' }}" disabled>
                <input type="hidden" name="fornecedor_new[endereco][uf]" value="{{ $e['uf'] ?? '' }}">
              </div>
              <div class="col-md-3">
                <label class="form-label">Cidade</label>
                <input class="form-control" value="{{ $e['cidade'] ?? '' }}" disabled>
                <input type="hidden" name="fornecedor_new[endereco][cidade]" value="{{ $e['cidade'] ?? '' }}">
              </div>
              <div class="col-md-3">
                <label class="form-label">Bairro</label>
                <input class="form-control" value="{{ $e['bairro'] ?? '' }}" disabled>
                <input type="hidden" name="fornecedor_new[endereco][bairro]" value="{{ $e['bairro'] ?? '' }}">
              </div>
              <div class="col-md-3">
                <label class="form-label">Logradouro</label>
                <input class="form-control" value="{{ $e['logradouro'] ?? '' }}" disabled>
                <input type="hidden" name="fornecedor_new[endereco][logradouro]" value="{{ $e['logradouro'] ?? '' }}">
              </div>
              <div class="col-md-2">
                <label class="form-label">Número</label>
                <input class="form-control" value="{{ $e['numero'] ?? '' }}" disabled>
                <input type="hidden" name="fornecedor_new[endereco][numero]" value="{{ $e['numero'] ?? '' }}">
              </div>
            @endif

            <div class="form-text">
              Os dados acima serão usados para criar o fornecedor automaticamente.
            </div>
          </div>
        @endif
      </div>
    </div>

    {{-- Itens / Produtos (auto: vincula por EAN ou prepara criação) --}}
    <div class="card shadow-sm mb-3">
      <div class="card-header d-flex align-items-center gap-2">
        <i class="fa-solid fa-box-open"></i>
        <strong>Produtos e Itens</strong>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hiper align-middle mb-0">
            <thead>
              <tr>
                <th>Descrição</th>
                <th class="text-mono">EAN</th>
                <th class="text-mono">NCM</th>
                <th style="width:460px">Vinculado / Cadastro</th>
                <th class="text-end" style="width:120px">Qtd</th>
                <th class="text-end" style="width:140px">Valor Unit.</th>
              </tr>
            </thead>
            <tbody>
              @foreach($draft['itens'] as $it)
                @php
                  $idx        = $it['index'];
                  $ean        = trim((string)($it['ean'] ?? ''));
                  $ncm        = $it['ncm_code'] ?? null;

                  // Procura produto pelo código de barras
                  $produtoEncontrado = null;
                  if ($ean !== '') {
                    $produtoEncontrado = \App\Models\Produto::where('codigo_barras', $ean)->first();
                  }
                @endphp
                <tr>
                  <td>{{ $it['descricao'] }}</td>
                  <td class="text-mono">{{ $ean !== '' ? $ean : '—' }}</td>
                  <td class="text-mono">{{ $ncm ?: '00000000' }}</td>

                  <td>
                    @if($produtoEncontrado)
                      {{-- Vinculado automaticamente --}}
                      <div class="alert alert-success py-2 px-3 mb-2 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-link"></i>
                        <div class="small">
                          <strong>Produto vinculado automaticamente pelo EAN.</strong><br>
                          {{ $produtoEncontrado->descricao }}
                          @if($produtoEncontrado->codigo_barras)
                            — <span class="text-mono">{{ $produtoEncontrado->codigo_barras }}</span>
                          @endif
                        </div>
                      </div>
                      <input type="hidden" name="produtos[{{ $idx }}][product_id]" value="{{ $produtoEncontrado->id }}">
                      <input type="hidden" name="produtos[{{ $idx }}][mode]" value="link">
                    @else
                      {{-- Não encontrou: preparar criação automática --}}
                      <div class="alert alert-warning py-2 px-3 mb-2 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div class="small">
                          <strong>Produto não encontrado pelo EAN.</strong> Vamos cadastrar automaticamente.
                        </div>
                      </div>

                      <input type="hidden" name="produtos[{{ $idx }}][mode]" value="new">
                      <div class="row g-2">
                        <div class="col-md-7">
                          <input name="produtos[{{ $idx }}][new][descricao]" class="form-control form-control-sm"
                                 value="{{ $it['descricao'] }}" placeholder="Descrição do produto" required>
                        </div>
                        <div class="col-md-5">
                          <input name="produtos[{{ $idx }}][new][codigo_barras]" class="form-control form-control-sm text-mono"
                                 placeholder="EAN (opcional)" value="{{ $ean }}">
                        </div>
                        <div class="col-md-6">
                          <select name="produtos[{{ $idx }}][new][categoria_produto]" class="form-select form-select-sm" required>
                            <option value="">Selecione uma categoria...</option>
                            @foreach($categorias as $c)
                              <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-3">
                          <input name="produtos[{{ $idx }}][new][unidade_medida]" class="form-control form-control-sm"
                                 value="{{ $it['unidade'] ?? 'UN' }}" placeholder="UN. Medida">
                        </div>
                        <div class="col-md-3">
                          <input name="produtos[{{ $idx }}][new][preco_venda]" class="form-control form-control-sm text-end text-mono"
                                 value="{{ number_format($it['valor_unit'],2,',','.') }}" placeholder="Preço de venda">
                        </div>
                      </div>
                    @endif
                  </td>

                  <td class="text-end text-mono">{{ number_format($it['quantidade'], 3, ',', '.') }}</td>
                  <td class="text-end text-mono">R$ {{ number_format($it['valor_unit'], 2, ',', '.') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="card-footer d-flex justify-content-end">
        <button class="btn btn-primary">
          <i class="fa-solid fa-floppy-disk me-2"></i> Lançar nota
        </button>
      </div>
    </div>
  </form>
@endif
