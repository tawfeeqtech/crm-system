<?php

namespace App\Models;

use App\Enums\StatusProjects;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

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
        'deadline' => 'datetime',

    ];

    // Accessor for deadline
    public function getDeadlineAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('m/d/Y') : null;
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

    // /**
    //  * Get the user's first name.
    //  */
    // public function getFormattedDeadlineAttribute()
    // {
    //     return $this->deadline ? $this->deadline->format('Y-m-d') : null;
    // }

    // public function setDeadlineAttribute($value)
    // {
    //     $this->attributes['deadline'] = $value ? \Carbon\Carbon::createFromFormat('Y-m-d', $value) : null;
    // }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->singleFile();
    }
}
