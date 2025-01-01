<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Application extends Model
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'full_name',
        'age',
        'email',
        'phone_number',
        'pin_no',
        'relation',
        'nid_or_birth_certificate_no',
        'gender',
        'role_id',
        'status'
    ];
}
