<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    /**
     * Display a listing of places with filters
     */
    public function index(Request $request)
    {
        $query = Place::with(['placeType', 'interests', 'company', 'schedules'])
            ->where('status', 'open');

        // Filtro por tipo de lugar
        if ($request->filled('place_type_id')) {
            $query->where('place_type_id', $request->place_type_id);
        }

        // Filtro por intereses del usuario
        if ($request->filled('my_interests') && Auth::check()) {
            $userInterests = Auth::user()->interests->pluck('id');
            if ($userInterests->isNotEmpty()) {
                $query->whereHas('interests', function ($q) use ($userInterests) {
                    $q->whereIn('interests.id', $userInterests);
                });
            }
        }

        // Filtro por intereses específicos
        if ($request->filled('interests')) {
            $interests = is_array($request->interests) ? $request->interests : [$request->interests];
            $query->whereHas('interests', function ($q) use ($interests) {
                $q->whereIn('interests.id', $interests);
            });
        }

        // Filtro por ubicación (si se proporciona)
        if ($request->filled(['latitude', 'longitude'])) {
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $radius = $request->filled('radius') ? $request->radius : 10;
            
            $query->nearby($latitude, $longitude, $radius);
        }

        // Filtro por búsqueda de texto
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Ordenamiento
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');
        
        if ($sortBy === 'distance' && $request->filled(['latitude', 'longitude'])) {
            // Ya se ordena por distancia en el scope nearby
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        $places = $query->paginate(12)->withQueryString();

        // Datos para los filtros
        $placeTypes = PlaceType::all();
        $interests = Interest::all();

        return view('places.index', compact('places', 'placeTypes', 'interests'));
    }

    /**
     * Display the specified place
     */
    public function show(Place $place)
    {
        $place->load(['placeType', 'interests', 'company', 'schedules']);
        
        // Lugares similares basados en intereses
        $similarPlaces = Place::where('id', '!=', $place->id)
            ->where('status', 'open')
            ->whereHas('interests', function ($q) use ($place) {
                $q->whereIn('interests.id', $place->interests->pluck('id'));
            })
            ->with(['placeType', 'company'])
            ->limit(4)
            ->get();

        return view('places.show', compact('place', 'similarPlaces'));
    }

    /**
     * Search places with AJAX
     */
    public function search(Request $request)
    {
        $query = Place::with(['placeType', 'company'])
            ->where('status', 'open');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $places = $query->limit(10)->get();

        return response()->json($places);
    }

    /**
     * Get places near a location
     */
    public function nearby(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'nullable|numeric|min:1|max:100',
        ]);

        $places = Place::with(['placeType', 'company'])
            ->where('status', 'open')
            ->nearby($request->latitude, $request->longitude, $request->radius ?? 10)
            ->limit(20)
            ->get();

        return response()->json($places);
    }
}
