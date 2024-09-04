<?php

namespace App\Models;

use App\Enums\StatusProjects;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'deadline',
        'status',
        'user_id',
        'client_id',
    ];

    protected $casts = [
        'status' => StatusProjects::class,
    ];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('m/d/Y');
    }
}
