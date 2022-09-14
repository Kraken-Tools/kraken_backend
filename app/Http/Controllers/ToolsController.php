<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WGenial\NumeroPorExtenso\NumeroPorExtenso;

use App\Services\ToolsService;

class ToolsController extends Controller
{
    public function numberInFull(Request $request)
    {
        $request->merge(['number' => $request->route('number')]);
        $validator = $request->validate(['number' => 'required|numeric']);

        $number_converter = new NumeroPorExtenso;
        $number_in_full = $number_converter->converter($request->number);

        return response()->json(['result' => $number_in_full]);
    }
}
