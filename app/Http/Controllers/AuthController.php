<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // TODO: VALIDAR REQUEST.
        $user_credentials = $request->only('email', 'password');

        if(!auth()->attempt($user_credentials)) {
            return response()->json(['message' => 'Login ou senha inválidos'], 401);
        }

        $access_token = auth()->user()->createToken('auth_token');

        return response()->json([
            'data' => [
                'token' => $access_token->plainTextToken
            ]
        ]);
    }


    public function register(Request $request, User $user)
    {
        // TODO: VALIDAR REQUEST.
        $user_credentials = $request->only('name', 'email', 'password');
        $user_credentials['password'] = \bcrypt($user_credentials['password']);

        if(!$user = $user->create($user_credentials)) {
            return response()->json(['message' => 'Erro durante a criação do usuário'], 500);
        }

        return response()->json([
            'data' => [
                'user' => $user
            ]
        ]);
    }

    public function logout()
    {
        // TODO: VALIDAR SE O TOKEN É REALMENTE DO USUÁRIO
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['msg' => 'Usuário deslogado'], 200);
    }
}
