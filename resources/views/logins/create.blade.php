@extends('layout')

@section('conteudo')
@push('styles')
<link href="{{ asset('css/pages/login_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho da página --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-user-lock page-head__icon"></i>
      <div>
        <h2 class="page-head__title">Criar Conta de Acesso</h2>
        <p class="page-head__subtitle">
          Vincule um e-mail e senha ao CNPJ da empresa para acessar o sistema.
        </p>
      </div>
    </div>

    {{-- Botão de ajuda (Popover Bootstrap) --}}
    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="Por que preciso criar este login?"
            data-bs-content="Este login será usado para acessar o sistema com permissões vinculadas ao CNPJ informado. Guarde sua senha em local seguro."
            aria-label="Ajuda sobre criação de login">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Balão fixo (coachmark) que não pode ser fechado --}}
  <div class="hint-bubble" id="hint-criar-login" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Crie o login para acessar o sistema</strong><br>
        O login fica <u>vinculado ao CNPJ</u> acima. Use um e-mail válido e uma senha forte (mín. 8 caracteres, misture letras e números).
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary hint-bubble__close" id="hint-close" style="display: none;">Entendi</button>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Erros de validação --}}
  @if ($errors->any())
    <div class="alert alert-danger mt-2">
      <ul class="mb-0">
        @foreach ($errors->all() as $erro)
          <li>{{ $erro }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Formulário --}}
  <form action="{{ route('logins.store') }}" method="POST" class="needs-validation mt-3" novalidate>
    @csrf

    <div class="card shadow-sm c-form">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
          <i class="fa-solid fa-id-badge"></i>
          <strong>Dados de Acesso</strong>
        </div>
        <span class="badge text-bg-primary">Novo</span>
      </div>

      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-4">
            <label for="cnpj" class="form-label">CNPJ</label>
            <input type="text"
                   name="cnpj"
                   id="cnpj"
                   class="form-control"
                   value="{{ old('cnpj', $cnpj ?? '') }}"
                   readonly
                   required>
            <div class="form-text">CNPJ vinculado a esta conta.</div>
          </div>

          <div class="col-md-8">
            <label for="email" class="form-label">E-mail</label>
            <input type="email"
                   name="email"
                   id="email"
                   class="form-control"
                   placeholder="seuemail@empresa.com.br"
                   value="{{ old('email') }}"
                   required>
            <div class="invalid-feedback">Informe um e-mail válido.</div>
          </div>

          <div class="col-md-6">
            <label for="senha" class="form-label">Senha</label>
            <div class="input-group">
              <input type="password"
                     name="senha"
                     id="senha"
                     class="form-control"
                     placeholder="Mínimo 8 caracteres"
                     minlength="8"
                     required
                     aria-describedby="btnToggleSenha">
              <button class="btn btn-outline-secondary" type="button" id="btnToggleSenha" aria-label="Mostrar senha">
                <i class="fa-regular fa-eye" id="iconSenha"></i>
              </button>
              <div class="invalid-feedback">Informe uma senha com pelo menos 8 caracteres.</div>
            </div>
            <div class="password-meter mt-2" aria-hidden="true">
              <div class="password-meter__bar" id="meterBar"></div>
            </div>
            <small id="meterText" class="text-muted">Força da senha: —</small>
          </div>

          <div class="col-md-6">
            <label for="senha_confirmation" class="form-label">Confirmar Senha</label>
            <input type="password"
                   name="senha_confirmation"
                   id="senha_confirmation"
                   class="form-control"
                   placeholder="Repita a senha"
                   minlength="8"
                   required>
            <div class="invalid-feedback">As senhas devem coincidir.</div>
          </div>
        </div>
      </div>

      <div class="card-footer d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary">
          <i class="fa-solid fa-user-plus"></i> Criar Login
        </button>
      </div>
    </div>
  </form>
</div>

@push('scripts')
<script>
  // Popover Bootstrap
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  // Coachmark fixo (não pode ser fechado)
  (function(){
    const bubble = document.getElementById('hint-criar-login');
    bubble?.classList.remove('d-none'); // Garante que o balão não será fechado
  })();

  // Mostrar/Ocultar senha
  (function(){
    const input = document.getElementById('senha');
    const btn = document.getElementById('btnToggleSenha');
    const icon = document.getElementById('iconSenha');

    btn?.addEventListener('click', () => {
      const isPwd = input.type === 'password';
      input.type = isPwd ? 'text' : 'password';
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
      btn.setAttribute('aria-label', isPwd ? 'Ocultar senha' : 'Mostrar senha');
    });
  })();

  // Indicador simples de força de senha
  (function(){
    const senha = document.getElementById('senha');
    const bar = document.getElementById('meterBar');
    const text = document.getElementById('meterText');

    function score(pwd){
      let s = 0;
      if (!pwd) return 0;
      if (pwd.length >= 8) s += 1;
      if (/[A-Z]/.test(pwd)) s += 1;
      if (/[a-z]/.test(pwd)) s += 1;
      if (/[0-9]/.test(pwd)) s += 1;
      if (/[^A-Za-z0-9]/.test(pwd)) s += 1;
      return Math.min(s, 5);
    }

    function label(n){
      return ['—','Muito fraca','Fraca','Média','Forte','Muito forte'][n];
    }

    senha?.addEventListener('input', () => {
      const n = score(senha.value);
      bar.style.width = (n*20)+'%';
      bar.dataset.level = n;
      text.textContent = 'Força da senha: ' + label(n);
    });
  })();

  // Validação Bootstrap + confirmação de senha
  (function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        // checa confirmação de senha
        const s1 = document.getElementById('senha')?.value || '';
        const s2 = document.getElementById('senha_confirmation')?.value || '';
        if (s1 !== s2) {
          event.preventDefault();
          event.stopPropagation();
          document.getElementById('senha_confirmation').setCustomValidity('As senhas não coincidem.');
        } else {
          document.getElementById('senha_confirmation').setCustomValidity('');
        }

        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>
@endpush
@endsection
