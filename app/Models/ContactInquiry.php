<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'whatsapp', 'event_type', 'event_date', 'message', 'status'];

    protected function casts(): array
    {
        return ['event_date' => 'date'];
    }
}
