<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Função para registrar um novo usuário
    public function register(Request $request) 
    {
        // Valida os campos enviados na requisição
        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        // Cria um novo usuário no banco de dados
        $user = User::create($fields);

        // Gera um token para o usuário recém-criado
        $token = $user->createToken($request->name);

        // Retorna os dados do usuário e o token
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    // Função para login do usuário
    public function login(Request $request) 
    {
        // Valida os campos de login (e-mail e senha)
        $fields = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        // Verifica se o usuário existe pelo e-mail
        $user = User::where('email', $request->email)->first();

        // Se o usuário não existe ou a senha está incorreta, retorna erro
        if(!$user || !Hash::check($request->password, $user->password)){
            return [
                'mensagem' => 'As credenciais fornecidas estão incorretas.'
            ];
        }

        // Gera um novo token para o usuário
        $token = $user->createToken($user->name);

        // Retorna os dados do usuário e o token de autenticação
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    // Função para logout do usuário
    public function logout(Request $request) 
    {
        // Deleta todos os tokens do usuário (logout)
        $request->user()->tokens()->delete();

        // Retorna uma mensagem de logout
        return [
            'mensagem' => 'Você saiu da sua conta.'
        ];
    }
}
