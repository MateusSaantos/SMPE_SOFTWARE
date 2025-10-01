@php
  // Resgata o rascunho da sessão
  $draft        = session("import_nfe.$token");
  $fornecedores = \App\Models\Fornecedor::orderBy('razao_social')->get(['cnpj','razao_social']);
  $categorias   = \App\Models\Categoria::orderBy('descricao')->get(['id','descricao']);
  $prodSugestoes= $draft['suggestions']['produtos'] ?? [];
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

    {{-- Fornecedor --}}
    <div class="card shadow-sm mb-3">
      <div class="card-header d-flex align-items-center gap-2">
        <i class="fa-solid fa-truck-field"></i>
        <strong>Fornecedor</strong>
      </div>
      <div class="card-body">
        <div class="row g-3 align-items-end">
          <div class="col-md-3">
            <label class="form-label">Modo</label>
            @php $sug = $draft['suggestions']['fornecedor_id'] ?? null; @endphp
            <select name="fornecedor_mode" id="fornecedor_mode" class="form-select" required>
              <option value="link" {{ $sug ? 'selected' : '' }}>Vincular existente</option>
              <option value="new"  {{ $sug ? '' : 'selected' }}>Criar novo</option>
            </select>
          </div>

          {{-- Vincular fornecedor existente --}}
          <div class="col-md-9 {{ $sug ? '' : 'd-none' }}" data-fornecedor="link">
            <label class="form-label">Fornecedor existente</label>
            <select name="fornecedor_id" class="form-select">
              <option value="">Selecione...</option>
              @foreach($fornecedores as $f)
                <option value="{{ $f->cnpj }}" {{ (string)$sug === (string)$f->cnpj ? 'selected' : '' }}>
                  {{ $f->razao_social }} — {{ $f->cnpj }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Criar novo fornecedor (somente leitura, a partir do XML) --}}
          <div class="col-12 {{ $sug ? 'd-none' : '' }}" data-fornecedor="new">
            <div class="row g-2">
              <div class="col-md-4">
                <label class="form-label">CNPJ</label>
                <input type="text" class="form-control text-mono" value="{{ $draft['fornecedor']['cnpj'] }}" disabled>
              </div>
              <div class="col-md-8">
                <label class="form-label">Razão Social</label>
                <input type="text" class="form-control" value="{{ $draft['fornecedor']['razao'] }}" disabled>
              </div>

              @if($draft['fornecedor']['endereco'])
                @php $e = $draft['fornecedor']['endereco']; @endphp
                <div class="col-md-2">
                  <label class="form-label">CEP</label>
                  <input class="form-control" value="{{ $e['cep'] }}" disabled>
                </div>
                <div class="col-md-1">
                  <label class="form-label">UF</label>
                  <input class="form-control" value="{{ $e['uf'] }}" disabled>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Cidade</label>
                  <input class="form-control" value="{{ $e['cidade'] }}" disabled>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Bairro</label>
                  <input class="form-control" value="{{ $e['bairro'] }}" disabled>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Logradouro</label>
                  <input class="form-control" value="{{ $e['logradouro'] }}" disabled>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Número</label>
                  <input class="form-control" value="{{ $e['numero'] }}" disabled>
                </div>
              @endif

              <div class="form-text">
                Os dados acima serão usados para criar o fornecedor, caso você não vincule um existente.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Itens / Produtos --}}
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
                <th>Modo</th>
                <th style="width:360px">Vincular / Cadastrar</th>
                <th class="text-end" style="width:120px">Qtd</th>
                <th class="text-end" style="width:140px">Valor Unit.</th>
              </tr>
            </thead>
            <tbody>
              @foreach($draft['itens'] as $it)
                @php
                  $idx      = $it['index'];
                  $sugId    = $prodSugestoes[$idx] ?? null;
                  $prodList = \App\Models\Produto::orderBy('descricao')->limit(200)->get(['id','descricao','codigo_barras']);
                @endphp
                <tr>
                  <td>{{ $it['descricao'] }}</td>
                  <td class="text-mono">{{ $it['ean'] ?: '—' }}</td>
                  <td class="text-mono">{{ $it['ncm_code'] ?: '00000000' }}</td>

                  <td style="width:140px">
                    <select name="produtos[{{ $idx }}][mode]" class="form-select form-select-sm js-prod-mode" data-row="{{ $idx }}">
                      <option value="link" {{ $sugId ? 'selected' : '' }}>Vincular</option>
                      <option value="new"  {{ $sugId ? '' : 'selected' }}>Criar</option>
                    </select>
                  </td>

                  <td>
                    {{-- Vincular existente --}}
                    <div data-prod-row="{{ $idx }}" data-mode="link" class="{{ $sugId ? '' : 'd-none' }}">
                      <select name="produtos[{{ $idx }}][product_id]" class="form-select form-select-sm">
                        <option value="">Selecione um produto...</option>
                        @foreach($prodList as $p)
                          <option value="{{ $p->id }}" {{ (string)$sugId === (string)$p->id ? 'selected' : '' }}>
                            {{ $p->descricao }} @if($p->codigo_barras) — {{ $p->codigo_barras }} @endif
                          </option>
                        @endforeach
                      </select>
                    </div>

                    {{-- Criar novo rapidamente --}}
                    <div data-prod-row="{{ $idx }}" data-mode="new" class="{{ $sugId ? 'd-none' : '' }}">
                      <div class="row g-2">
                        <div class="col-md-7">
                          <input name="produtos[{{ $idx }}][new][descricao]" class="form-control form-control-sm" value="{{ $it['descricao'] }}">
                        </div>
                        <div class="col-md-5">
                          <input name="produtos[{{ $idx }}][new][codigo_barras]" class="form-control form-control-sm text-mono" placeholder="EAN (opcional)" value="{{ $it['ean'] }}">
                        </div>
                        <div class="col-md-6">
                          <select name="produtos[{{ $idx }}][new][categoria_produto]" class="form-select form-select-sm">
                            @foreach($categorias as $c)
                              <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-3">
                          <input name="produtos[{{ $idx }}][new][unidade_medida]" class="form-control form-control-sm" value="{{ $it['unidade'] ?? 'UN' }}">
                        </div>
                        <div class="col-md-3">
                          <input name="produtos[{{ $idx }}][new][preco_venda]" class="form-control form-control-sm text-end text-mono" value="{{ number_format($it['valor_unit'],2,',','.') }}">
                        </div>
                      </div>
                    </div>
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

  @push('scripts')
  <script>
  // Alternância "Vincular" x "Criar" por item usando classe d-none
  document.querySelectorAll('.js-prod-mode').forEach(sel => {
    sel.addEventListener('change', () => {
      const idx = sel.dataset.row;
      document.querySelectorAll(`[data-prod-row="${idx}"]`).forEach(div => {
        const shouldShow = (div.getAttribute('data-mode') === sel.value);
        div.classList.toggle('d-none', !shouldShow);
      });
    });
  });

  // Alternância do fornecedor (link/new) usando classe d-none
  const fSel = document.getElementById('fornecedor_mode');
  if (fSel){
    const updateF = () => {
      document.querySelectorAll('[data-fornecedor]').forEach(div => {
        const shouldShow = (div.getAttribute('data-fornecedor') === fSel.value);
        div.classList.toggle('d-none', !shouldShow);
      });
    };
    fSel.addEventListener('change', updateF);
    updateF();
  }
  </script>
  @endpush
@endif
