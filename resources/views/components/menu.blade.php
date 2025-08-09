<!-- Botão hamburger (responsivo) -->
<button id="menu-toggle" class="menu-toggle">
    <i class="fas fa-bars"></i>
</button>

<div class="menu-container" id="sidebarMenu">
    <div class="menu-header">SMPE Software</div>
    <ul>
        <li class="has-submenu">
            <div class="menu-item-label">
                <i class="fas fa-folder-open"></i> Cadastros
                <span class="submenu-icon"><i class="fas fa-chevron-down"></i></span>
            </div>
            <ul class="submenu">
                <li><a href="#"><i class="fas fa-truck"></i> Fornecedor</a></li>
                <li><a href="#"><i class="fas fa-box"></i> Produtos</a></li>
            </ul>
        </li>
        <li class="has-submenu">
            <div class="menu-item-label">
                <i class="fas fa-building"></i> Empresa
                <span class="submenu-icon"><i class="fas fa-chevron-down"></i></span>
            </div>
            <ul class="submenu">
                <li><a href="{{ route('logins.create') }}"><i class="fas fa-user-plus"></i> Criar usuário</a></li>
                <li><a href="#"><i class="fas fa-chalkboard-teacher"></i> Educativo</a></li>
            </ul>
        </li>
        <li class="has-submenu">
            <div class="menu-item-label">
                <i class="fas fa-file-invoice"></i> Nota Fiscal
                <span class="submenu-icon"><i class="fas fa-chevron-down"></i></span>
            </div>
            <ul class="submenu">
                <li><a href="#"><i class="fas fa-file-import"></i> Importar XML</a></li>
                <li><a href="#"><i class="fas fa-keyboard"></i> Inserir nota manual</a></li>
            </ul>
        </li>
    </ul>
</div>
