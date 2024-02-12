<?php

namespace Quimaira\Customers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'whatsapp',
        'street',
        'postal_code',
        'department',
        'city',
        'state',
        'message',
    ];
}
