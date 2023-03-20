<?php

namespace App\Notifications;

use App\Models\Expense;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/*
|--------------------------------------------------------------------------
| RegisteredExpenseNotification - Notificação para envio de e-mail
|--------------------------------------------------------------------------
|
| Esta Notification é chamada pelo Evento ExpenseCreated, e é responsável
| por enviar um e-mail para o usuário que cadastrou uma despesa de forma
| assíncrona utilizando as queues do Laravel.
|
*/

class RegisteredExpenseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Expense $expense)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Onfly | Despesa cadastrada 💙')
            ->greeting('Olá, ' . $notifiable->name . '! 👋')
            ->line('Você tem uma nova despesa registrada!')
            ->action('Checar Despesa ✈️', '#')
            ->line('Obrigado pelo voto de confiança à nossa equipe. 💙');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
