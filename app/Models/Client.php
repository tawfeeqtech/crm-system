<?php

namespace App\Models;

use App\Enums\StatusClients;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company',
        'vat',
        'address',
        'status',
    ];

    protected $casts = [
        'status' => StatusClients::class,
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
