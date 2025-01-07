<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presonertask extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id', 
        'pin_no', 
        'task_details', 
        'task_date', 
        'start_at', 
        'end_at', 
        'task_evaluate', 
        'remarks', 
        'task_mark', 
        'status'
    ];
}
