<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $interests = Interest::withCount('users')->orderBy('name')->paginate(15);
        return view('admin.interests.index', compact('interests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.interests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:interests',
            'description' => 'nullable|string|max:500',
        ]);

        Interest::create($request->all());

        return redirect()->route('admin.interests.index')
            ->with('success', 'Interés creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Interest $interest)
    {
        $interest->load(['users:id,name,email']);
        return view('admin.interests.show', compact('interest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interest $interest)
    {
        return view('admin.interests.edit', compact('interest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Interest $interest)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:interests,name,' . $interest->id,
            'description' => 'nullable|string|max:500',
        ]);

        $interest->update($request->all());

        return redirect()->route('admin.interests.index')
            ->with('success', 'Interés actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interest $interest)
    {
        if ($interest->users()->count() > 0) {
            return redirect()->route('admin.interests.index')
                ->with('error', 'No se puede eliminar este interés porque tiene usuarios asociados.');
        }

        $interest->delete();

        return redirect()->route('admin.interests.index')
            ->with('success', 'Interés eliminado exitosamente.');
    }
}
