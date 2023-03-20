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

class ExpenseController extends Controller
{
    use ApiResponserTrait;

    /**
     * Middlewares de da ExpensePolicy para cada método, visto que a rota é resource
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Expense::class, 'expense'); // App\Policies\ExpensePolicy
    }

    /**
     * Cria uma nova despesa vinculada ao usuário logado
     *
     * @param StoreExpenseRequest $request
     * @return void
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
     * @param Expense $expense
     * @return JsonResponse
     */
    public function show(Expense $expense): JsonResponse
    {
        return $this->success('Despesa listada com sucesso.',
            (new ExpenseListResource($expense))
        );
    }

    /**
     * Faz a atualização de uma despesa específica
     *
     * @param UpdateExpenseRequest $request
     * @param Expense $expense
     * @return void
     */
    public function update(UpdateExpenseRequest $request, Expense $expense): JsonResponse
    {
        $expense->update($request->validated());

        return $this->success('Despesa atualizada com sucesso.',
            (new ExpenseResource($expense))
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense): JsonResponse
    {
        $expense->delete();

        return $this->success('Despesa removida com sucesso.');
    }
}
