@extends('layout')

@section('conteudo')

<div">
    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Adiciona um estado falso no histórico
            history.pushState(null, document.title, location.href);

            window.addEventListener('popstate', function (event) {
                // Sempre "empurra" de volta para o dashboard
                history.pushState(null, document.title, location.href);
            });
        });
    </script>
    @endpush
</div>
@endsection
