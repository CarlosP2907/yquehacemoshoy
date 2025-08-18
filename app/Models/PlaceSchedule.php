<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PlaceSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'day_of_week',
        'open_time',
        'close_time',
        'is_closed',
        'is_24_hours',
        'special_note',
    ];

    protected $casts = [
        'open_time' => 'datetime:H:i',
        'close_time' => 'datetime:H:i',
        'is_closed' => 'boolean',
        'is_24_hours' => 'boolean',
    ];

    /**
     * Días de la semana en español
     */
    public static function getDaysInSpanish()
    {
        return [
            'monday' => 'Lunes',
            'tuesday' => 'Martes',
            'wednesday' => 'Miércoles',
            'thursday' => 'Jueves',
            'friday' => 'Viernes',
            'saturday' => 'Sábado',
            'sunday' => 'Domingo',
        ];
    }

    /**
     * Relación con el lugar
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * Obtener el nombre del día en español
     */
    public function getDayNameAttribute()
    {
        return self::getDaysInSpanish()[$this->day_of_week] ?? $this->day_of_week;
    }

    /**
     * Formatear horario para mostrar
     */
    public function getFormattedScheduleAttribute()
    {
        if ($this->is_closed) {
            return 'Cerrado';
        }

        if ($this->is_24_hours) {
            return '24 horas';
        }

        if ($this->open_time && $this->close_time) {
            return Carbon::parse($this->open_time)->format('H:i') . ' - ' . Carbon::parse($this->close_time)->format('H:i');
        }

        return 'Horario no definido';
    }

    /**
     * Verificar si está abierto en un momento específico
     */
    public function isOpenAt($time = null)
    {
        if (!$time) {
            $time = now();
        }

        if ($this->is_closed) {
            return false;
        }

        if ($this->is_24_hours) {
            return true;
        }

        if (!$this->open_time || !$this->close_time) {
            return false;
        }

        $currentTime = Carbon::parse($time)->format('H:i:s');
        $openTime = Carbon::parse($this->open_time)->format('H:i:s');
        $closeTime = Carbon::parse($this->close_time)->format('H:i:s');

        // Manejar casos donde el lugar cierra después de medianoche
        if ($closeTime < $openTime) {
            return $currentTime >= $openTime || $currentTime <= $closeTime;
        }

        return $currentTime >= $openTime && $currentTime <= $closeTime;
    }
}
