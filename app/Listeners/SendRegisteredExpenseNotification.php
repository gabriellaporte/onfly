<?php

namespace App\Listeners;

use App\Events\ExpenseCreated;
use App\Notifications\RegisteredExpenseNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/*
|--------------------------------------------------------------------------
| SendRegisteredExpenseNotification - Listener para disparar notificação,
| atendendo ao evento ExpenseCreated
|--------------------------------------------------------------------------
|
| Este é o Listener do evento "ExpenseCreated". Ele é responsável por
| disparar a notificação de despesa registrada, usando o método "notify"
| do usuário relacionado à despesa pelo Laravel Notifications.
|
*/
class SendRegisteredExpenseNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Lida com o evento disparado
     *
     * @param ExpenseCreated $event     [Evento de criação de despesa]
     * @return void
     */
    public function handle(ExpenseCreated $event): void
    {
        $event->expense
            ->user
            ->notify(new RegisteredExpenseNotification($event->expense));
    }
}
