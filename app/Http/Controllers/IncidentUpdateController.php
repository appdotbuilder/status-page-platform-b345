<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncidentUpdateRequest;
use App\Models\Incident;
use App\Models\IncidentUpdate;
use Inertia\Inertia;

class IncidentUpdateController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncidentUpdateRequest $request, Incident $incident)
    {
        $validatedData = $request->validated();
        $validatedData['incident_id'] = $incident->id;

        $update = IncidentUpdate::create($validatedData);

        // Update the incident status if provided
        if (isset($validatedData['status'])) {
            $incident->update(['status' => $validatedData['status']]);
            
            // If resolved, set resolved_at timestamp
            if ($validatedData['status'] === 'resolved') {
                $incident->update(['resolved_at' => now()]);
            }
        }

        return redirect()->route('incidents.show', $incident)
            ->with('success', 'Incident update posted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incident $incident, IncidentUpdate $incidentUpdate)
    {
        $incidentUpdate->delete();

        return redirect()->route('incidents.show', $incident)
            ->with('success', 'Incident update deleted successfully.');
    }
}