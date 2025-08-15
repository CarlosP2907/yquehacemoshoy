<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'content',
        'image',
        'publish_date',
        'status',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
    ];

    protected function casts(): array
    {
        return [
            'publish_date' => 'datetime',
            'start_date' => 'date',
            'end_date' => 'date',
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }

    /**
     * Relación con empresa
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relación con comentarios
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relación con reacciones
     */
    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    /**
     * Relación con imágenes
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Scope para posts publicados
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope para posts activos (dentro de fechas)
     */
    public function scopeActive($query)
    {
        return $query->where(function($q) {
            $q->whereNull('start_date')
              ->orWhere('start_date', '<=', now()->toDateString());
        })->where(function($q) {
            $q->whereNull('end_date')
              ->orWhere('end_date', '>=', now()->toDateString());
        });
    }
}space App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
}
