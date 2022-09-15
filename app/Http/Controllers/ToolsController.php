<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ToolService;

class ToolsController extends Controller
{
    public function numberInFull(Request $request)
    {
        $request->merge(['number' => $request->route('number')]);
        $validator = $request->validate(['number' => 'required|numeric']);

        $number_in_full = ToolService::getNumberInFull($request->number);

        return response()->json(['result' => $number_in_full]);
    }
}
