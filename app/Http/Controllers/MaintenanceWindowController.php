<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaintenanceWindowRequest;
use App\Http\Requests\UpdateMaintenanceWindowRequest;
use App\Models\Component;
use App\Models\MaintenanceWindow;
use Inertia\Inertia;

class MaintenanceWindowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenanceWindows = MaintenanceWindow::with('components')
            ->latest('scheduled_start')
            ->paginate(10);

        return Inertia::render('maintenance/index', [
            'maintenanceWindows' => $maintenanceWindows
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

        return Inertia::render('maintenance/create', [
            'components' => $components
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaintenanceWindowRequest $request)
    {
        $validatedData = $request->validated();
        $componentIds = $validatedData['component_ids'] ?? [];
        unset($validatedData['component_ids']);

        $maintenanceWindow = MaintenanceWindow::create($validatedData);

        if (!empty($componentIds)) {
            $maintenanceWindow->components()->attach($componentIds);
        }

        return redirect()->route('maintenance.show', $maintenanceWindow)
            ->with('success', 'Maintenance window created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceWindow $maintenanceWindow)
    {
        $maintenanceWindow->load('components.componentGroup');

        return Inertia::render('maintenance/show', [
            'maintenanceWindow' => $maintenanceWindow
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceWindow $maintenanceWindow)
    {
        $components = Component::with('componentGroup')
            ->orderBy('name')
            ->get();

        $maintenanceWindow->load('components');

        return Inertia::render('maintenance/edit', [
            'maintenanceWindow' => $maintenanceWindow,
            'components' => $components
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaintenanceWindowRequest $request, MaintenanceWindow $maintenanceWindow)
    {
        $validatedData = $request->validated();
        $componentIds = $validatedData['component_ids'] ?? [];
        unset($validatedData['component_ids']);

        $maintenanceWindow->update($validatedData);

        $maintenanceWindow->components()->sync($componentIds);

        return redirect()->route('maintenance.show', $maintenanceWindow)
            ->with('success', 'Maintenance window updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceWindow $maintenanceWindow)
    {
        $maintenanceWindow->delete();

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance window deleted successfully.');
    }
}