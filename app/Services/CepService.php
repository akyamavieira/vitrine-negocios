<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CepService
{
    public static function buscarEndereco(string $cep): ?array
    {
        if (strlen($cep) < 8) {
            return null;
        }

        try {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

            if ($response->failed() || isset($response['erro'])) {
                return null;
            }

            return $response->json();
        } catch (\Exception $e) {
            return null;
        }
    }
}