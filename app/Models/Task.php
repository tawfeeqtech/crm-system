<?php

namespace App\Models;

use App\Enums\StatusTasks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'status' => StatusTasks::class,
    ];
}
