<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncidentRequest;
use App\Http\Requests\UpdateIncidentRequest;
use App\Models\Component;
use App\Models\Incident;
use Inertia\Inertia;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incidents = Incident::with(['components', 'updates'])
            ->latest('started_at')
            ->paginate(10);

        return Inertia::render('incidents/index', [
            'incidents' => $incidents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $components = Component::with('componentGroup')
            ->orderBy('name')
            ->get();

        return Inertia::render('incidents/create', [
            'components' => $components
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncidentRequest $request)
    {
        $validatedData = $request->validated();
        $componentIds = $validatedData['component_ids'] ?? [];
        unset($validatedData['component_ids']);

        $incident = Incident::create($validatedData);

        if (!empty($componentIds)) {
            $incident->components()->attach($componentIds);
        }

        return redirect()->route('incidents.show', $incident)
            ->with('success', 'Incident created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Incident $incident)
    {
        $incident->load(['components.componentGroup', 'updates']);

        return Inertia::render('incidents/show', [
            'incident' => $incident
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Incident $incident)
    {
        $components = Component::with('componentGroup')
            ->orderBy('name')
            ->get();

        $incident->load('components');

        return Inertia::render('incidents/edit', [
            'incident' => $incident,
            'components' => $components
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncidentRequest $request, Incident $incident)
    {
        $validatedData = $request->validated();
        $componentIds = $validatedData['component_ids'] ?? [];
        unset($validatedData['component_ids']);

        $incident->update($validatedData);

        $incident->components()->sync($componentIds);

        return redirect()->route('incidents.show', $incident)
            ->with('success', 'Incident updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incident $incident)
    {
        $incident->delete();

        return redirect()->route('incidents.index')
            ->with('success', 'Incident deleted successfully.');
    }
}