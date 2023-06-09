<?php

namespace App\Models;

use App\Events\ExpenseCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses';

    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'date'
    ];

    protected $dispatchesEvents = [
        'created' => ExpenseCreated::class
    ];

    /**
     * Mostra o usuário relacionado à despesa
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
