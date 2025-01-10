<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presonertask extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id', 'pin_no', 'date', 'start_at', 'end_at',
        'description', 'remarks', 'marks', 'task_status', 'status', 'ass_id',
    ];
}