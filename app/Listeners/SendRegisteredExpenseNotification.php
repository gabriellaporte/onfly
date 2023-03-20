<?php

namespace App\Listeners;

use App\Events\ExpenseCreated;
use App\Notifications\RegisteredExpenseNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
     * Handle the event.
     */
    public function handle(ExpenseCreated $event): void
    {
        $event->expense->user->notify(new RegisteredExpenseNotification($event->expense));
    }
}
