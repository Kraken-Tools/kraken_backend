<?php

namespace App\Services;

use WGenial\NumeroPorExtenso\NumeroPorExtenso;

class ToolService {
    public static function getNumberInFull($number) {
        $number_converter = new NumeroPorExtenso;
        $number_in_full = $number_converter->converter($number);

        $number_in_units = explode(" ", $number_in_full);
        $words = count($number_in_units);
        unset($number_in_units[$words-1]);


        if(($number >= 1000 && $number <= 2000) && $number_in_units[0] == "um") {
            unset($number_in_units[0]);
        }

        if($number >= 1000000) {
            unset($number_in_units[$words-2]);
        }

        return implode(" ", $number_in_units);
    }

    public static function callSpellCheckerApi($text)
    {
        $curl = curl_init();

        $post_parameters = json_encode([
            'key' => env('SPELL_CHECKER_API_KEY'),
            'text' => $text,
            'language' => 'pt-BR'
        ]);

        curl_setopt($curl, CURLOPT_URL, 'https://api.textgears.com/spelling');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_parameters);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
