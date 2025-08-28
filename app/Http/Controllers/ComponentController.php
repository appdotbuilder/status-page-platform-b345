<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use App\Models\Component;
use App\Models\ComponentGroup;
use Inertia\Inertia;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $components = Component::with('componentGroup')
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('components/index', [
            'components' => $components
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $componentGroups = ComponentGroup::orderBy('name')->get();

        return Inertia::render('components/create', [
            'componentGroups' => $componentGroups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComponentRequest $request)
    {
        $component = Component::create($request->validated());

        return redirect()->route('components.index')
            ->with('success', 'Component created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Component $component)
    {
        $component->load(['componentGroup', 'incidents', 'maintenanceWindows']);

        return Inertia::render('components/show', [
            'component' => $component
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Component $component)
    {
        $componentGroups = ComponentGroup::orderBy('name')->get();

        return Inertia::render('components/edit', [
            'component' => $component,
            'componentGroups' => $componentGroups
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComponentRequest $request, Component $component)
    {
        $component->update($request->validated());

        return redirect()->route('components.index')
            ->with('success', 'Component updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Component $component)
    {
        $component->delete();

        return redirect()->route('components.index')
            ->with('success', 'Component deleted successfully.');
    }
}