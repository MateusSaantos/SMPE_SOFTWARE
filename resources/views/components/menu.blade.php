@php
    // Garante que pega o CNPJ de forma segura (mesmo sendo array)
    $usuario = session('usuario');
    $cnpjLogado = data_get($usuario, 'empresa.cnpj') ?? data_get($usuario, 'cnpj');

    // Helpers de estado
    $isOpen = function ($patterns) {
        $patterns = (array)$patterns;
        foreach ($patterns as $p) {
            if (request()->routeIs($p)) return 'is-open';
        }
        return '';
    };
    $isActive = function ($patterns) {
        $patterns = (array)$patterns;
        foreach ($patterns as $p) {
            if (request()->routeIs($p)) return 'is-active';
        }
        return '';
    };
@endphp

<aside class="menu-container" id="sidebarMenu">
  <div class="menu-header"></div>

  <ul>
    <!-- Cadastros -->
    <li class="has-submenu {{ $isOpen(['fornecedores.*','produtos.*','categorias.*','ncms.*']) }}">
      <div class="menu-item-top">
        <div class="menu-item-label">
          <i class="fas fa-folder-open"></i> Cadastros
        </div>
        <span class="submenu-icon"><i class="fas fa-chevron-down"></i></span>
      </div>
      <ul class="submenu">
        <li>
          <a class="{{ $isActive('fornecedores.*') }}" href="{{ route('fornecedores.index') }}">
            <i class="fa-solid fa-truck-field"></i> Fornecedores
          </a>
        </li>
        <li>
          <a class="{{ $isActive('produtos.*') }}" href="{{ route('produtos.index') }}">
            <i class="fas fa-box"></i> Produtos
          </a>
        </li>
        <li>
          <a class="{{ $isActive('categorias.*') }}" href="{{ route('categorias.index') }}">
            <i class="fa-solid fa-tags"></i> Categorias de produtos
          </a>
        </li>
        <li>
          <a class="{{ $isActive('ncms.*') }}" href="{{ route('ncms.index') }}">
            <i class="fa-solid fa-barcode"></i> NCM
          </a>
        </li>
      </ul>
    </li>

    <!-- Empresa -->
    <li class="has-submenu {{ $isOpen(['empresas.*','educativos.*']) }}">
      <div class="menu-item-top">
        <div class="menu-item-label">
          <i class="fas fa-building"></i> Empresa
        </div>
        <span class="submenu-icon"><i class="fas fa-chevron-down"></i></span>
      </div>
      <ul class="submenu">
        <li>
          <a class="{{ $isActive('empresas.*') }}" href="{{ $cnpjLogado ? route('empresas.create_user', ['cnpj' => $cnpjLogado]) : route('empresas.create_user') }}">
            <i class="fas fa-user-plus"></i> Criar usuário
          </a>
        </li>
        <li>
          <a class="{{ $isActive(['educativos.index','educativos.show']) }}" href="{{ route('educativos.index') }}">
            <i class="fas fa-chalkboard-teacher"></i> Educativos
          </a>
        </li>
      </ul>
    </li>

    <!-- Nota Fiscal -->
    <li class="has-submenu {{ $isOpen(['notas.*']) }}">
      <div class="menu-item-top">
        <div class="menu-item-label">
          <i class="fas fa-file-invoice"></i> Nota Fiscal
        </div>
        <span class="submenu-icon"><i class="fas fa-chevron-down"></i></span>
      </div>
      <ul class="submenu">
        <li>
          <a class="{{ $isActive('notas.index') }}" href="{{ route('notas.index') }}">
            <i class="fas fa-list"></i> Listar notas
          </a>
        </li>
        <li>
          <a class="{{ $isActive('notas.create') }}" href="{{ route('notas.create') }}">
            <i class="fas fa-keyboard"></i> Inserir nota manual
          </a>
        </li>
        <li>
          <a class="{{ $isActive('notas.import.form') }}" href="{{ route('notas.import.form') }}">
            <i class="fas fa-file-import"></i> Importar XML
          </a>
        </li>
      </ul>
    </li>

    <!-- Precificação -->
    <li class="has-submenu {{ $isOpen(['simulacoes-precos.*']) }}">
      <div class="menu-item-top">
        <div class="menu-item-label">
          <i class="fas fa-calculator"></i> Precificação
        </div>
        <span class="submenu-icon"><i class="fas fa-chevron-down"></i></span>
      </div>
      <ul class="submenu">
        <li>
          <a class="{{ $isActive('simulacoes-precos.create') }}" href="{{ route('simulacoes-precos.create') }}">
            <i class="fas fa-sliders-h"></i> Simulador de preços
          </a>
        </li>
        <li>
          <a class="{{ $isActive('simulacoes-precos.index') }}" href="{{ route('simulacoes-precos.index') }}">
            <i class="fas fa-history"></i> Histórico de simulações
          </a>
        </li>
      </ul>
    </li>
  </ul>
</aside>
