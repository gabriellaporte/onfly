<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseListResource;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Traits\ApiResponserTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| ExpenseController - Requisições relacionadas às despesas (CRUD)
|--------------------------------------------------------------------------
|
| Aqui é o Controller responsável por lidar com as requisições para despesas,
| estando a cargo do CRUD principal da API. Todas as funções retornam um JSON
| seguindo o padrão da trait ApiResponserTrait, com as melhores práticas.
|
*/

class ExpenseController extends Controller
{
    use ApiResponserTrait;

    /**
     * Construtor do Controller, distribui as permissões de acesso (ACL) para as funções
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Expense::class, 'expense'); // App\Policies\ExpensePolicy
    }

    /**
     * Cria uma nova despesa vinculada ao usuário logado. Emite o evento ExpenseCreatedEvent
     *
     * @param StoreExpenseRequest $request  [Form Request com as regras de validação]
     * @return JsonResponse
     */
    public function store(StoreExpenseRequest $request): JsonResponse
    {
        $expense = Expense::create($request->validated());

        return $this->success('Despesa criada com sucesso.',
            (new ExpenseResource($expense)), 201);
    }

    /**
     * Mostra uma despesa específica
     *
     * @param Expense $expense  [Despesa a ser listada]
     * @return JsonResponse
     */
    public function show(Expense $expense): JsonResponse
    {
        return $this->success('Despesa listada com sucesso.',
            (new ExpenseListResource($expense))
        );
    }

    /**
     * Faz a atualização de uma despesa específica. Aceita PUT e PATCH
     *
     * @param UpdateExpenseRequest $request [Form Request com as regras de validação]
     * @param Expense $expense  [Despesa a ser atualizada]
     * @return JsonResponse
     */
    public function update(UpdateExpenseRequest $request, Expense $expense): JsonResponse
    {
        $expense->update($request->validated());

        return $this->success('Despesa atualizada com sucesso.',
            (new ExpenseResource($expense))
        );
    }

    /**
     * Deleta uma despesa específica
     *
     * @param Expense $expense  [Despesa a ser deletada]
     * @return JsonResponse
     */
    public function destroy(Expense $expense): JsonResponse
    {
        $expense->delete();

        return $this->success('Despesa removida com sucesso.', null, 204);
    }
}
