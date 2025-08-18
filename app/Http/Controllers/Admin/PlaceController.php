<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Interest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Place::with(['placeType', 'interests', 'company']);

        // Filtros
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        if ($request->filled('place_type_id')) {
            $query->where('place_type_id', $request->place_type_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $places = $query->paginate(15)->withQueryString();

        // Datos para filtros
        $companies = Company::all();
        $placeTypes = PlaceType::all();

        return view('admin.places.index', compact('places', 'companies', 'placeTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $placeTypes = PlaceType::all();
        $interests = Interest::all();
        
        return view('admin.places.create', compact('companies', 'placeTypes', 'interests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'place_type_id' => 'required|exists:place_type,id',
            'company_id' => 'nullable|exists:companies,id',
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
        ]);

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

        return redirect()->route('admin.places.index')
            ->with('success', 'Lugar creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        $place->load(['placeType', 'interests', 'company']);
        
        return view('admin.places.show', compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        $companies = Company::all();
        $placeTypes = PlaceType::all();
        $interests = Interest::all();
        $selectedInterests = $place->interests->pluck('id')->toArray();
        
        return view('admin.places.edit', compact('place', 'companies', 'placeTypes', 'interests', 'selectedInterests'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'place_type_id' => 'required|exists:place_type,id',
            'company_id' => 'nullable|exists:companies,id',
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

        return redirect()->route('admin.places.index')
            ->with('success', 'Lugar actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        // Eliminar imagen si existe
        if ($place->image && Storage::disk('public')->exists($place->image)) {
            Storage::disk('public')->delete($place->image);
        }

        $place->delete();

        return redirect()->route('admin.places.index')
            ->with('success', 'Lugar eliminado exitosamente.');
    }

    /**
     * Toggle place status
     */
    public function toggleStatus(Place $place)
    {
        $place->update([
            'status' => $place->status === 'open' ? 'closed' : 'open'
        ]);

        return redirect()->back()
            ->with('success', 'Estado del lugar actualizado exitosamente.');
    }
}
