<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    use AuthorizesRequests, ValidatesRequests;

    public const HTTP_CODES = [200, 201];

    /**
     * @param mixed $response
     * 
     * @return JsonResponse
     */
    protected function output(mixed $response, int $httpCode): JsonResponse
    {
        $mensagem = 'Operação realizada com sucesso.';

        if (! in_array($httpCode, self::HTTP_CODES)) {
            $httpCode = 400;
            $mensagem = 'Erro ao realizar operação.';
        }
        
        return response()->json([
            'message'      => $mensagem,
            'data'         => $response,
        ], $httpCode);
    }

}