<?php

namespace App\Models;

use App\Enums\StatusClients;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Client extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'company',
        'vat',
        'address',
        'status',
    ];

    protected $casts = [
        'status' => StatusClients::class,
    ];


    public static function options()
    {
        return self::select('id', 'company')->get()->map(function ($client) {
            return [
                'label' => $client->company,
                'value' => $client->id,
            ];
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->singleFile();
    }

    // Accessor for created_at
    public function getCreatedAtAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('m/d/Y') : null;
    }

    // Accessor for updated_at
    public function getUpdatedAtAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('m/d/Y') : null;
    }
}
