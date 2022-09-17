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

    public function spellChecker(Request $request)
    {
        $text = ToolService::callSpellCheckerApi($request->input('text'));

        return response()->json(['response' => $text]);
    }
}
