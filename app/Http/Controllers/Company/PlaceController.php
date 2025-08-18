<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Auth::guard('company')->user();
        $places = Place::where('company_id', $company->id)
            ->with(['placeType', 'interests', 'schedules'])
            ->paginate(10);

        return view('company.places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $placeTypes = PlaceType::all();
        $interests = Interest::all();
        
        return view('company.places.create', compact('placeTypes', 'interests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = Auth::guard('company')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'place_type_id' => 'required|exists:place_type,id',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'price_range' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interests' => 'array',
            'interests.*' => 'exists:interests,id',
            'schedules' => 'nullable|array',
            'schedules.*.is_closed' => 'nullable|boolean',
            'schedules.*.is_24_hours' => 'nullable|boolean',
            'schedules.*.open_time' => 'nullable|date_format:H:i',
            'schedules.*.close_time' => 'nullable|date_format:H:i',
            'schedules.*.special_note' => 'nullable|string|max:255',
        ]);

        $validated['company_id'] = $company->id;
        $validated['status'] = 'open';

        // Manejar la imagen
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('places', 'public');
            $validated['image'] = $path;
        }

        $place = Place::create($validated);

        // Asociar intereses
        if (isset($validated['interests'])) {
            $place->interests()->sync($validated['interests']);
        }

        // Crear horarios
        if (isset($validated['schedules'])) {
            $this->createSchedules($place, $validated['schedules']);
        }

        return redirect()->route('company.places.index')
            ->with('success', 'Lugar creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        $company = Auth::guard('company')->user();
        
        if ($place->company_id !== $company->id) {
            abort(403);
        }

        $place->load(['placeType', 'interests', 'schedules']);
        
        return view('company.places.show', compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        $company = Auth::guard('company')->user();
        
        if ($place->company_id !== $company->id) {
            abort(403);
        }

        $placeTypes = PlaceType::all();
        $interests = Interest::all();
        $selectedInterests = $place->interests->pluck('id')->toArray();
        
                // Cargar horarios existentes
        $place->load('schedules');
        $existingSchedules = [];
        foreach ($place->schedules as $schedule) {
            $existingSchedules[$schedule->day_of_week] = [
                'is_closed' => $schedule->is_closed,
                'is_24_hours' => $schedule->is_24_hours,
                'open_time' => $schedule->open_time ? substr($schedule->open_time, 0, 5) : null,
                'close_time' => $schedule->close_time ? substr($schedule->close_time, 0, 5) : null,
                'special_note' => $schedule->special_note,
            ];
        }
        
        return view('company.places.edit', compact('place', 'placeTypes', 'interests', 'selectedInterests', 'existingSchedules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $company = Auth::guard('company')->user();
        
        if ($place->company_id !== $company->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'place_type_id' => 'required|exists:place_type,id',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'status' => 'required|in:open,closed',
            'price_range' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interests' => 'array',
            'interests.*' => 'exists:interests,id',
            'schedules' => 'nullable|array',
            'schedules.*.is_closed' => 'nullable|boolean',
            'schedules.*.is_24_hours' => 'nullable|boolean',
            'schedules.*.open_time' => 'nullable|date_format:H:i',
            'schedules.*.close_time' => 'nullable|date_format:H:i',
            'schedules.*.special_note' => 'nullable|string|max:255',
        ]);

        // Manejar la imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($place->image && Storage::disk('public')->exists($place->image)) {
                Storage::disk('public')->delete($place->image);
            }
            
            $path = $request->file('image')->store('places', 'public');
            $validated['image'] = $path;
        }

        $place->update($validated);

        // Actualizar intereses
        if (isset($validated['interests'])) {
            $place->interests()->sync($validated['interests']);
        } else {
            $place->interests()->detach();
        }

        // Actualizar horarios
        if (isset($validated['schedules'])) {
            // Eliminar horarios existentes
            $place->schedules()->delete();
            // Crear nuevos horarios
            $this->createSchedules($place, $validated['schedules']);
        }

        return redirect()->route('company.places.index')
            ->with('success', 'Lugar actualizado exitosamente.');
    }

    /**
     * Create schedules for a place
     */
    private function createSchedules(Place $place, array $schedules)
    {
        $days = [
            'monday' => 'monday',
            'tuesday' => 'tuesday',
            'wednesday' => 'wednesday',
            'thursday' => 'thursday',
            'friday' => 'friday',
            'saturday' => 'saturday',
            'sunday' => 'sunday'
        ];

        foreach ($schedules as $dayKey => $scheduleData) {
            if (!isset($days[$dayKey])) {
                continue;
            }

            $scheduleData = array_filter($scheduleData, function($value) {
                return $value !== null && $value !== '';
            });

            if (empty($scheduleData)) {
                continue;
            }

            $isClosed = isset($scheduleData['is_closed']) && $scheduleData['is_closed'];
            $is24Hours = isset($scheduleData['is_24_hours']) && $scheduleData['is_24_hours'];

            $openTime = null;
            $closeTime = null;

            if (!$isClosed) {
                if ($is24Hours) {
                    $openTime = '00:00:00';
                    $closeTime = '23:59:59';
                } else {
                    $openTime = isset($scheduleData['open_time']) ? $scheduleData['open_time'] . ':00' : null;
                    $closeTime = isset($scheduleData['close_time']) ? $scheduleData['close_time'] . ':00' : null;
                }
            }

            // Solo crear el horario si tiene información válida
            if ($isClosed || ($openTime && $closeTime) || $is24Hours) {
                $place->schedules()->create([
                    'day_of_week' => $days[$dayKey],
                    'is_closed' => $isClosed,
                    'is_24_hours' => $is24Hours,
                    'open_time' => $openTime,
                    'close_time' => $closeTime,
                    'special_note' => $scheduleData['special_note'] ?? null,
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        $company = Auth::guard('company')->user();
        
        if ($place->company_id !== $company->id) {
            abort(403);
        }

        // Eliminar imagen si existe
        if ($place->image && Storage::disk('public')->exists($place->image)) {
            Storage::disk('public')->delete($place->image);
        }

        $place->delete();

        return redirect()->route('company.places.index')
            ->with('success', 'Lugar eliminado exitosamente.');
    }
}
