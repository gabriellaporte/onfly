<?php

namespace App\Traits;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| Esta trait será usada para padronizar as responses ao Client
|
*/

use Illuminate\Http\JsonResponse;

trait ApiResponserTrait {

    /**
     * Retorna uma response de sucesso ao usuário
     *
     * @param string|null $message  Mensagem de retorno
     * @param mixed|null $data      Os dados retornados
     * @param int $code             O código de retorno HTTP
     * @return JsonResponse
     */
    protected function success(string $message = null, mixed $data = null, int $code = 200): JsonResponse
    {
        return response()->json($this->clearArray([
            'message' => $message,
            'data' => $data
        ]), $code);
    }

    /**
     * Retorna uma response de sucesso ao usuário com links (segundo o padrão HATEOAS)
     *
     * @param mixed|null $data      Os dados retornados
     * @param string|null $message  Mensagem de retorno
     * @param string|null $links    Os links retornados (HATEOAS)
     * @param int $code             O código de retorno HTTP
     * @return JsonResponse
     */
    protected function successWithLinks(string $message = null, mixed $data = null, int $code = 200, array $links = null): JsonResponse
    {
        return response()->json($this->clearArray([
            'data' => $data,
            'message' => $message,
            'links' => $links
        ]), $code);
    }

    /**
     * Retorna uma response de erro ao usuário
     *
     * @param string|null $message  A mensagem de erro
     * @param array|null $errors    Os erros retornados
     * @param int $code             O código de retorno HTTP
     * @return JsonResponse
     */
    protected function error(string $message = null, int $code = 400, array $errors = null): JsonResponse
    {
        return response()->json($this->clearArray([
            'message' => $message,
            'errors' => $errors
        ]), $code);
    }

    /**
     * Remove valores nulos de um array
     *
     * @param array $array
     * @return array
     */
    private function clearArray(array $array): array
    {
        return array_filter($array, fn($value) => !is_null($value));
    }
}
