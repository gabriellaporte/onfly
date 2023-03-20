<?php

namespace App\Events;

use App\Models\Expense;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/*
|--------------------------------------------------------------------------
| ExpenseCreated - Evento de criação de despesa (store)
|--------------------------------------------------------------------------
|
| Este é o Event que é disparado após a criação de uma despesa no método
| ExpenseController@store. Ele é responsável por encapsular a despesa e
| enviá-la para o Listener SendRegisteredExpenseNotification, que irá
| cuidar do restante do processo (notificações).
*/

class ExpenseCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Construtor do evento
     *
     * @param Expense $expense  [Property promotion da Despesa]
     */
    public function __construct(public Expense $expense)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
