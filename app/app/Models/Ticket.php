<?php

namespace App\Models;

use App\Models\Attachment as ModelsAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'status',
        'user_id', 'agent_id',
        'type', 'transport_mode', 'product',
        'origin_country', 'destination_country'
    ];

    // Usuario que creó el ticket
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Agente asignado al ticket
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function attachments()
    {
        return $this->hasMany(ModelsAttachment::class);
    }

    public function messages()
{
    return $this->hasMany(TicketMessage::class);
}

}
