<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{

    protected $fillable = [
        'ticket_id',
        'original_name',
        'path',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

}
