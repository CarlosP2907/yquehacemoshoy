<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $table = 'place';

    protected $fillable = [
        'name',
        'place_type_id',
        'description',
        'location',
        'longitude',
        'latitude',
        'image',
        'phone',
        'website',
        'rating',
        'price_range',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'decimal:1',
            'price_range' => 'decimal:2',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
        ];
    }

    /**
     * Relación con tipo de lugar
     */
    public function placeType()
    {
        return $this->belongsTo(PlaceType::class);
    }

    /**
     * Relación con intereses (many to many)
     */
    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'place_interest');
    }

    /**
     * Relación con eventos
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Relación con imágenes
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Scope para buscar lugares cercanos
     */
    public function scopeNearby($query, $latitude, $longitude, $radius = 10)
    {
        return $query->selectRaw("
            *,
            (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
        ", [$latitude, $longitude, $latitude])
        ->havingRaw('distance <= ?', [$radius])
        ->orderBy('distance');
    }
}space App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //
}
