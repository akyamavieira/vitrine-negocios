<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class CnpjService
{
    /**
     * URL base da API do Receita WS.
     */
    protected const BASE_URL = 'https://www.receitaws.com.br/v1/cnpj/';

    /**
     * Consulta o CNPJ na API do Receita WS.
     *
     * @param string $cnpj
     * @return array
     * @throws Exception
     */
    public static function consultarCnpj(string $cnpj): array
    {
        // Remove caracteres não numéricos do CNPJ
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Verifica se o CNPJ tem 14 dígitos
        if (strlen($cnpj) !== 14) {
            throw new Exception('CNPJ inválido. Deve conter 14 dígitos.');
        }

        // Faz a requisição à API
        $response = Http::withoutVerifying()->get(self::BASE_URL . $cnpj);

        // Verifica se a requisição foi bem-sucedida
        if ($response->successful()) {
            $data = $response->json();

            // Verifica se o CNPJ é válido
            if (isset($data['status']) && $data['status'] === 'OK') {
                return $data; // Retorna os dados da empresa
            } else {
                throw new Exception('CNPJ não encontrado ou inválido.');
            }
        }

        throw new Exception('Erro ao consultar o CNPJ na API do Receita WS.');
    }
}