<!-- resources/views/components/header.blade.php -->
<nav class="navbar fixed-top topbar">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <span class="navbar-brand mb-0 h1">SeuSistema | Gestão</span>

        @if ($usuario)
            <div class="dropdown">
                <button class="btn btn-user dropdown-toggle d-flex align-items-center"
                        type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-2"></i>
                    {{ $usuario->email }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-edit me-2"></i> Alterar dados</a></li>
                    <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt me-2"></i> Sair
                    </a></li>
                </ul>
            </div>
        @endif
    </div>
</nav>
