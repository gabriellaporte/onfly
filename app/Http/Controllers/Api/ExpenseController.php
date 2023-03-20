<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
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
     * Cria uma nova despesa
     *
     * @param Request $request
     * @return void
     */
    public function store(StoreExpenseRequest $request): JsonResponse
    {
        $expense = Expense::create($request->validated());

        return $this->success('Despesa criada com sucesso.',
            (new ExpenseResource($expense)));
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return $this->success('Despesa listada com sucesso.',
            (new ExpenseListResource($expense))
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
