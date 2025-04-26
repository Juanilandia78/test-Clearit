<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketStatusUpdated extends Notification
{
    use Queueable;

    protected $ticket;
    protected $customMessage;

    public function __construct(Ticket $ticket, string $customMessage)
    {
        $this->ticket = $ticket;
        $this->customMessage = $customMessage;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'ticket_id' => $this->ticket->id,
            'title' => 'Ticket #' . $this->ticket->id . ' updated',
            'message' => $this->customMessage,
            'url' => route($notifiable->isAgent() ? 'agent.tickets.show' : 'user.tickets.show', $this->ticket),
        ];
    }
}
