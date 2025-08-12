<?php
// Controle de login de usuários

namespace App\Http\Controllers;

use App\Models\Login; // Modelo que representa a tabela 'logins'
use Illuminate\Http\Request; // Manipulação de dados da requisição HTTP
use Illuminate\Support\Facades\Hash; // Para criptografar/verificar senhas
use Illuminate\Support\Facades\Session; // Manipulação de sessão no Laravel

class LoginController extends Controller
{   
    /**
     * Exibe o formulário de login para o usuário.
     */
    public function showLoginForm()
    {
        return view('logins.index');
    }

    /**
     * Exibe o formulário de criação de login (usuário do sistema).
     * Recebe opcionalmente o CNPJ para já preencher no campo.
     */
    public function create(Request $request)
    {
        $cnpj = $request->get('cnpj'); // Pega o CNPJ da query string
        return view('logins.create', compact('cnpj'));
    }

    /**
     * Salva um novo login no banco (com senha criptografada).
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'cnpj' => 'required|exists:empresas,cnpj', // CNPJ precisa existir na tabela 'empresas'
            'email' => 'required|email|unique:logins,email', // Email único
            'senha' => 'required|min:6', // Senha mínima de 6 caracteres
        ]);

        // Criação do login no banco
        Login::create([
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'senha' => Hash::make($request->senha), // Criptografia segura
        ]);

        return redirect()->route('login.form')->with('success', 'Login criado com sucesso.');
    }

    /**
     * Realiza a autenticação do usuário.
     */
    public function login(Request $request)
    {
        // Validação dos campos do formulário
        $request->validate([
            'cnpj' => 'required',
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        // Busca o login no banco filtrando por CNPJ e email
        $login = Login::where('cnpj', $request->cnpj)
                      ->where('email', $request->email)
                      ->first();

        // Verifica se o login existe e se a senha informada confere
        if ($login && Hash::check($request->senha, $login->senha)) {
            // Armazena informações do usuário na sessão
            Session::put('usuario', [
                'id' => $login->id,
                'email' => $login->email,
                'cnpj' => $login->cnpj
            ]);
            return redirect()->route('dashboard');
        }

        // Caso falhe, retorna com erro
        return back()->withErrors(['erro' => 'Credenciais inválidas.']);
    }

    /**
     * Faz logout limpando os dados da sessão.
     */
    public function logout()
    {
        Session::forget('usuario'); // Remove informações do usuário
        return redirect()->route('login.form');
    }

    /**
     * Exibe o painel (dashboard) somente para usuários autenticados.
     */
    public function dashboard()
    {
        // Se não estiver logado, redireciona para o login
        if (!Session::has('usuario')) {
            return redirect()->route('login.form');
        }

        return view('logins.dashboard');
    }
}
