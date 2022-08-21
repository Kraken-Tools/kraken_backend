<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Helpers\UserHelper;

class UserController extends Controller
{
    /**
     * TODO: VERIFICAR SE O EMAIL JÁ EXISTE NO BANCO DE DADOS
     * TODO: REMOVER A COLUNA NAME DA TABELA USER_ACCESS_TOKENS (E REMOVER TAMBÉM NO INSERT DA USERHELPER)
     */

    public function save_token(Request $request)
    {
        $user_validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|filled',
            'name' => 'required|nullable',
            'access_token' => 'required|filled'
        ]);

        if($user_validator->fails()) {
            return response()->json([
                'error' => 'Some request parameters failed at validation',
                'failed_fields' => $user_validator->errors()
            ], 400);
        }

        UserHelper::save_or_update_user($request->all());

        return response()->json([
            'email' => $request->email,
            'name' => $request->name,
            'access_token' => $request->access_token
        ]);
    }
}
