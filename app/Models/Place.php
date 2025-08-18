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
        'company_id',
        'description',
        'location',
        'longitude',
        'latitude',
        'image',
        'phone',
        'website',
        'status',
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
     * Relación con empresa
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relación con intereses (many to many)
     */
    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'place_interest');
    }

    /**
     * Relación con horarios
     */
    public function schedules()
    {
        return $this->hasMany(PlaceSchedule::class)->orderByRaw("
            CASE day_of_week
                WHEN 'monday' THEN 1
                WHEN 'tuesday' THEN 2
                WHEN 'wednesday' THEN 3
                WHEN 'thursday' THEN 4
                WHEN 'friday' THEN 5
                WHEN 'saturday' THEN 6
                WHEN 'sunday' THEN 7
            END
        ");
    }

    /**
     * Verificar si está abierto ahora
     */
    public function isOpenNow()
    {
        $dayNames = [
            0 => 'sunday',
            1 => 'monday',
            2 => 'tuesday',
            3 => 'wednesday',
            4 => 'thursday',
            5 => 'friday',
            6 => 'saturday'
        ];
        
        $today = $dayNames[now()->dayOfWeek];
        $todaySchedule = $this->schedules()->where('day_of_week', $today)->first();
        
        if (!$todaySchedule) {
            return false; // Sin horario definido
        }

        return $todaySchedule->isOpenAt();
    }

    /**
     * Obtener el horario de hoy
     */
    public function getTodaySchedule()
    {
        $dayNames = [
            0 => 'sunday',
            1 => 'monday',
            2 => 'tuesday',
            3 => 'wednesday',
            4 => 'thursday',
            5 => 'friday',
            6 => 'saturday'
        ];
        
        $today = $dayNames[now()->dayOfWeek];
        return $this->schedules()->where('day_of_week', $today)->first();
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

    /**
     * Scope para filtrar por estado
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    /**
     * Scope para filtrar por tipo de lugar
     */
    public function scopeByType($query, $placeTypeId)
    {
        return $query->where('place_type_id', $placeTypeId);
    }

    /**
     * Scope para filtrar por intereses
     */
    public function scopeByInterests($query, $interestIds)
    {
        return $query->whereHas('interests', function ($q) use ($interestIds) {
            $q->whereIn('interests.id', $interestIds);
        });
    }
}
