<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validação das credenciais de login
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validação falhou', 'errors' => $validator->errors()], 422);
        }

        // Tentativa de login com Auth
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            return response()->json(['message' => 'Login bem-sucedido', 'user' => $user]);
        } else {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
    }

    public function register(Request $request)
    {
        // Validação dos dados de registro
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // A senha deve ser confirmada
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validação falhou', 'errors' => $validator->errors()], 422);
        }

        try {
            // Criação do novo usuário
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Criptografa a senha
            ]);

            // Retornar os dados do usuário
            return response()->json(['message' => 'Usuário registrado com sucesso', 'user' => $user], 201);

        } catch (\Exception $e) {
            // Retornar mensagem de erro
            return response()->json(['message' => 'Erro ao registrar usuário', 'error' => $e->getMessage()], 500);
        }
    }
}
