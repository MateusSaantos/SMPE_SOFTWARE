@php
    // Garante que pega o CNPJ de forma segura (mesmo sendo array)
    $usuario = session('usuario');
    $cnpjLogado = data_get($usuario, 'empresa.cnpj') ?? data_get($usuario, 'cnpj');
@endphp

<aside class="menu-container" id="sidebarMenu">
  <div class="menu-header"></div>

  <ul>
    <!-- Cadastros -->
    <li class="has-submenu">
      <div class="menu-item-top">
        <div class="menu-item-label">
          <i class="fas fa-folder-open"></i> Cadastros
        </div>
        <span class="submenu-icon"><i class="fas fa-chevron-down"></i></span>
      </div>
      <ul class="submenu">
        <li>
          <a href="{{ route('fornecedores.index') }}">
            <i class="fa-solid fa-truck-field"></i> Fornecedores
          </a>
        </li>

        <li>
          <a href="{{ route('produtos.index') }}">
            <i class="fas fa-box"></i> Produtos
          </a>
        </li>

        <li>
          <a href="{{ route('categorias.index') }}">
            <i class="fa-solid fa-tags"></i> Categorias de produtos
          </a>
        </li>

        <li>
          <a href="{{ route('ncms.index') }}">
            <i class="fa-solid fa-barcode"></i> NCM
          </a>
        </li>
        
      </ul>
    </li>

    <!-- Empresa -->
    <li class="has-submenu">
      <div class="menu-item-top">
        <div class="menu-item-label">
          <i class="fas fa-building"></i> Empresa
        </div>
        <span class="submenu-icon"><i class="fas fa-chevron-down"></i></span>
      </div>
      <ul class="submenu">
        <li>
          <a href="{{ $cnpjLogado ? route('empresas.create_user', ['cnpj' => $cnpjLogado]) : route('empresas.create_user') }}">
            <i class="fas fa-user-plus"></i> Criar usuário
          </a>
        </li>
        <li><a href="#"><i class="fas fa-chalkboard-teacher"></i> Educativo</a></li>
      </ul>
    </li>

    <!-- Nota Fiscal -->
    <li class="has-submenu">
      <div class="menu-item-top">
        <div class="menu-item-label">
          <i class="fas fa-file-invoice"></i> Nota Fiscal
        </div>
        <span class="submenu-icon"><i class="fas fa-chevron-down"></i></span>
      </div>
      <ul class="submenu">
        <li><a href="#"><i class="fas fa-file-import"></i> Importar XML</a></li>
        <li><a href="#"><i class="fas fa-keyboard"></i> Inserir nota manual</a></li>
      </ul>
    </li>
  </ul>
</aside>
