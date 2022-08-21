<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * TODO: VERIFICAR SE O EMAIL JÁ EXISTE NO BANCO DE DADOS
     */

    public function save_token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|filled',
            'name' => 'required|nullable',
            'access_token' => 'required|filled'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => 'Some request parameters failed at validation',
                'failed_fields' => $validator->errors()
            ], 400);
        }

        return response()->json([
            'email' => $request->email,
            'name' => $request->name,
            'access_token' => $request->access_token
        ]);
    }
}
