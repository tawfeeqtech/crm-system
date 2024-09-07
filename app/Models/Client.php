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
        'contact_name',
        'contact_email',
        'contact_phone_number',
        'company_name',
        'company_address',
        'company_city',
        'company_zip',
        'company_vat'
    ];

    protected $casts = [
        'status' => StatusClients::class,
    ];


    public static function options()
    {
        return self::select('id', 'contact_name')->get()->map(function ($client) {
            return [
                'label' => $client->contact_name,
                'value' => $client->id,
            ];
        });
    }

    public function setCompanyNameAttribute($value)
    {
        $this->attributes['company_name'] = ucfirst($value);
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
}
