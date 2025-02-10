<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CepService
{
    public static function buscarEndereco(string $cep): ?array
    {
        if (strlen($cep) < 8) {
            Log::warning("CEP inválido: {$cep}");
            return null;
        }

        try {
            Log::info("Buscando endereço para CEP: {$cep}");

            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

            if ($response->failed()) {
                Log::error("Falha na requisição para o CEP {$cep}: " . $response->body());
                return null;
            }

            $data = $response->json();

            if (isset($data['erro'])) {
                Log::warning("CEP não encontrado: {$cep}");
                return null;
            }

            Log::info("Endereço encontrado para CEP {$cep}: " . json_encode($data));

            return $data;
        } catch (\Exception $e) {
            Log::error("Erro ao buscar CEP {$cep}: " . $e->getMessage());
            return null;
        }
    }
}