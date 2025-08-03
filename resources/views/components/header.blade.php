<!-- resources/views/components/header.blade.php -->
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid d-flex justify-content-between">
        <span class="navbar-brand mb-0 h1">SMPE Software</span>

        @if ($usuario)
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $usuario->email }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Alterar dados</a></li>
                    <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Sair</a></li>
                </ul>
            </div>
        @endif
    </div>
</nav>
