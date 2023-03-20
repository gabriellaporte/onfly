<?php

namespace App\Exceptions;

use App\Traits\ApiResponserTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponserTrait;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Tratativa para erros, retornando um JSON para casos específicos.
     *
     * @param $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception) {
        if($exception instanceof AuthenticationException) {
            return $this->error('Você deve estar logado para fazer uma requisição.', 401);
        }

        if ($exception instanceof AuthorizationException) {
            return $this->error('Você não tem permissão para acessar este recurso.', 403);
        }

        if($exception instanceof ModelNotFoundException) {
            return $this->error('Recurso não encontrado.', 404);
        }

        if($exception instanceof MethodNotAllowedHttpException) {
            return $this->error('Método não permitido.', 405);
        }

        return parent::render($request, $exception);
    }

}
