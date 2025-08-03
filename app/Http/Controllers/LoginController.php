<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('logins.index');
    }

    public function create(Request $request)
    {
        $cnpj = $request->get('cnpj');
        return view('logins.create', compact('cnpj'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cnpj' => 'required|exists:empresas,cnpj',
            'email' => 'required|email|unique:logins,email',
            'senha' => 'required|min:6',
        ]);

        Login::create([
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        return redirect()->route('login.form')->with('success', 'Login criado com sucesso.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'cnpj' => 'required',
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        $login = Login::where('cnpj', $request->cnpj)
                      ->where('email', $request->email)
                      ->first();

        if ($login && Hash::check($request->senha, $login->senha)) {
            Session::put('usuario', $login->id);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['erro' => 'Credenciais inválidas.']);
    }

    public function logout()
    {
        Session::forget('usuario');
        return redirect()->route('login.form');
    }

    public function dashboard()
    {
        if (!Session::has('usuario')) {
            return redirect()->route('login.form');
        }

        return view('logins.dashboard');
    }
}
