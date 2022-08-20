<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function save_token()
    {
        return response()->json(['access_token' => 'teste']);
    }
}
