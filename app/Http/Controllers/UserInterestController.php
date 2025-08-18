<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInterestController extends Controller
{
    /**
     * Mostrar la pantalla de selección de intereses
     */
    public function show()
    {
        // Solo usuarios autenticados que no han seleccionado intereses
        $user = Auth::user();
        
        // Si ya tiene intereses, redirigir al template
        if ($user->interests()->count() > 0) {
            return redirect()->route('freeUser-template');
        }
        
        $interests = Interest::orderBy('name')->get();
        
        return view('interests.select', compact('interests'));
    }
    
    /**
     * Guardar los intereses seleccionados
     */
    public function store(Request $request)
    {
        $request->validate([
            'interests' => 'required|array|min:1',
            'interests.*' => 'exists:interests,id'
        ], [
            'interests.required' => 'Debes seleccionar al menos un interés.',
            'interests.min' => 'Debes seleccionar al menos un interés.',
        ]);
        
        $user = Auth::user();
        
        // Sync los intereses seleccionados
        $user->interests()->sync($request->interests);
        
        return redirect()->route('freeUser-template')
            ->with('success', '¡Excelente! Hemos guardado tus intereses para personalizaR tus recomendaciones.');
    }
    
    /**
     * Permitir omitir la selección de intereses
     */
    public function skip()
    {
        return redirect()->route('freeUser-template')
            ->with('info', 'Puedes configurar tus intereses más tarde desde tu perfil.');
    }
    
    /**
     * Mostrar la pantalla para editar intereses existentes
     */
    public function edit()
    {
        $user = Auth::user();
        $interests = Interest::orderBy('name')->get();
        $userInterests = $user->interests->pluck('id')->toArray();
        
        return view('interests.edit', compact('interests', 'userInterests'));
    }
    
    /**
     * Actualizar los intereses del usuario
     */
    public function update(Request $request)
    {
        $request->validate([
            'interests' => 'nullable|array',
            'interests.*' => 'exists:interests,id'
        ]);
        
        $user = Auth::user();
        
        // Sync los intereses seleccionados (vacío si no hay ninguno)
        $user->interests()->sync($request->interests ?? []);
        
        return redirect()->route('interests.edit')
            ->with('success', 'Tus intereses han sido actualizados correctamente.');
    }
}
