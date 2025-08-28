<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComponentGroupRequest;
use App\Http\Requests\UpdateComponentGroupRequest;
use App\Models\ComponentGroup;
use Inertia\Inertia;

class ComponentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $componentGroups = ComponentGroup::with('components')
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('component-groups/index', [
            'componentGroups' => $componentGroups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('component-groups/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComponentGroupRequest $request)
    {
        $componentGroup = ComponentGroup::create($request->validated());

        return redirect()->route('component-groups.index')
            ->with('success', 'Component group created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ComponentGroup $componentGroup)
    {
        $componentGroup->load('components');

        return Inertia::render('component-groups/show', [
            'componentGroup' => $componentGroup
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComponentGroup $componentGroup)
    {
        return Inertia::render('component-groups/edit', [
            'componentGroup' => $componentGroup
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComponentGroupRequest $request, ComponentGroup $componentGroup)
    {
        $componentGroup->update($request->validated());

        return redirect()->route('component-groups.index')
            ->with('success', 'Component group updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComponentGroup $componentGroup)
    {
        $componentGroup->delete();

        return redirect()->route('component-groups.index')
            ->with('success', 'Component group deleted successfully.');
    }
}