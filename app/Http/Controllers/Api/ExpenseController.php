<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Traits\ApiResponserTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    use ApiResponserTrait;

    /**
     * Cria uma nova despesa
     *
     * @param Request $request
     * @return void
     */
    public function store(StoreExpenseRequest $request): JsonResponse
    {
        $data = $request->validated();

        $expense = Expense::create($data);

        return $this->success('Despesa criada com sucesso.', new ExpenseResource($expense));
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return $this->success('Despesa (ID: ' . $expense->id . ') listada com sucesso.', new ExpenseResource($expense));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
