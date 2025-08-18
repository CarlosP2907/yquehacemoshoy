<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Place;
use App\Models\PlaceSchedule;

class PlaceScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = Place::all();

        foreach ($places as $place) {
            $this->createSchedulesForPlace($place);
        }
    }

    private function createSchedulesForPlace(Place $place)
    {
        // Definir horarios típicos según el tipo de lugar
        $schedules = $this->getTypicalSchedules($place->placeType->name ?? 'general');

        foreach ($schedules as $dayOfWeek => $schedule) {
            PlaceSchedule::create([
                'place_id' => $place->id,
                'day_of_week' => $dayOfWeek,
                'open_time' => $schedule['open_time'],
                'close_time' => $schedule['close_time'],
                'is_closed' => $schedule['is_closed'],
                'is_24_hours' => $schedule['is_24_hours'],
                'special_note' => $schedule['special_note'] ?? null,
            ]);
        }
    }

    private function getTypicalSchedules($placeType)
    {
        $baseSchedules = [
            'restaurant' => [
                // Lunes a Jueves
                'monday' => ['open_time' => '12:00:00', 'close_time' => '23:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'tuesday' => ['open_time' => '12:00:00', 'close_time' => '23:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'wednesday' => ['open_time' => '12:00:00', 'close_time' => '23:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'thursday' => ['open_time' => '12:00:00', 'close_time' => '23:00:00', 'is_closed' => false, 'is_24_hours' => false],
                // Viernes y Sábado
                'friday' => ['open_time' => '12:00:00', 'close_time' => '01:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'saturday' => ['open_time' => '12:00:00', 'close_time' => '01:00:00', 'is_closed' => false, 'is_24_hours' => false],
                // Domingo
                'sunday' => ['open_time' => '12:00:00', 'close_time' => '22:00:00', 'is_closed' => false, 'is_24_hours' => false],
            ],
            'bar' => [
                'monday' => ['open_time' => '18:00:00', 'close_time' => '02:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'tuesday' => ['open_time' => '18:00:00', 'close_time' => '02:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'wednesday' => ['open_time' => '18:00:00', 'close_time' => '02:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'thursday' => ['open_time' => '18:00:00', 'close_time' => '03:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'friday' => ['open_time' => '18:00:00', 'close_time' => '04:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'saturday' => ['open_time' => '18:00:00', 'close_time' => '04:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'sunday' => ['open_time' => null, 'close_time' => null, 'is_closed' => true, 'is_24_hours' => false],
            ],
            'cafe' => [
                'monday' => ['open_time' => '07:00:00', 'close_time' => '20:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'tuesday' => ['open_time' => '07:00:00', 'close_time' => '20:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'wednesday' => ['open_time' => '07:00:00', 'close_time' => '20:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'thursday' => ['open_time' => '07:00:00', 'close_time' => '20:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'friday' => ['open_time' => '07:00:00', 'close_time' => '22:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'saturday' => ['open_time' => '08:00:00', 'close_time' => '22:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'sunday' => ['open_time' => '08:00:00', 'close_time' => '20:00:00', 'is_closed' => false, 'is_24_hours' => false],
            ],
            'shop' => [
                'monday' => ['open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'tuesday' => ['open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'wednesday' => ['open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'thursday' => ['open_time' => '09:00:00', 'close_time' => '18:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'friday' => ['open_time' => '09:00:00', 'close_time' => '20:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'saturday' => ['open_time' => '09:00:00', 'close_time' => '20:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'sunday' => ['open_time' => null, 'close_time' => null, 'is_closed' => true, 'is_24_hours' => false],
            ],
            'gym' => [
                'monday' => ['open_time' => '06:00:00', 'close_time' => '22:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'tuesday' => ['open_time' => '06:00:00', 'close_time' => '22:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'wednesday' => ['open_time' => '06:00:00', 'close_time' => '22:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'thursday' => ['open_time' => '06:00:00', 'close_time' => '22:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'friday' => ['open_time' => '06:00:00', 'close_time' => '21:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'saturday' => ['open_time' => '08:00:00', 'close_time' => '20:00:00', 'is_closed' => false, 'is_24_hours' => false],
                'sunday' => ['open_time' => '08:00:00', 'close_time' => '18:00:00', 'is_closed' => false, 'is_24_hours' => false],
            ],
        ];

        // Usar horarios por defecto si no hay configuración específica
        return $baseSchedules[$placeType] ?? $baseSchedules['shop'];
    }
}
