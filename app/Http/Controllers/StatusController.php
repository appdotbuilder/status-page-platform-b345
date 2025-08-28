<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\ComponentGroup;
use App\Models\Incident;
use App\Models\MaintenanceWindow;
use Inertia\Inertia;

class StatusController extends Controller
{
    /**
     * Display the main status page.
     */
    public function index()
    {
        $componentGroups = ComponentGroup::with('components')
            ->orderBy('sort_order')
            ->get();

        $activeIncidents = Incident::with(['components', 'updates'])
            ->whereIn('status', ['investigating', 'identified', 'monitoring'])
            ->latest('started_at')
            ->get();

        $recentIncidents = Incident::with(['components', 'updates'])
            ->where('status', 'resolved')
            ->latest('resolved_at')
            ->take(5)
            ->get();

        $upcomingMaintenance = MaintenanceWindow::with('components')
            ->where('status', 'scheduled')
            ->where('scheduled_start', '>', now())
            ->orderBy('scheduled_start')
            ->take(3)
            ->get();

        $inProgressMaintenance = MaintenanceWindow::with('components')
            ->where('status', 'in_progress')
            ->orderBy('scheduled_start')
            ->get();

        // Calculate overall status
        $overallStatus = $this->calculateOverallStatus($componentGroups, $activeIncidents);

        return Inertia::render('status/index', [
            'componentGroups' => $componentGroups,
            'activeIncidents' => $activeIncidents,
            'recentIncidents' => $recentIncidents,
            'upcomingMaintenance' => $upcomingMaintenance,
            'inProgressMaintenance' => $inProgressMaintenance,
            'overallStatus' => $overallStatus,
        ]);
    }

    /**
     * Calculate the overall system status.
     */
    protected function calculateOverallStatus($componentGroups, $activeIncidents)
    {
        // Check for active incidents
        if ($activeIncidents->where('impact', 'critical')->count() > 0) {
            return 'critical';
        }
        
        if ($activeIncidents->where('impact', 'major')->count() > 0) {
            return 'major';
        }

        if ($activeIncidents->where('impact', 'minor')->count() > 0) {
            return 'minor';
        }

        // Check component statuses
        $hasIssues = false;
        foreach ($componentGroups as $group) {
            foreach ($group->components as $component) {
                if (in_array($component->status, ['degraded', 'partial_outage', 'major_outage'])) {
                    $hasIssues = true;
                    break;
                }
            }
        }

        return $hasIssues ? 'issues' : 'operational';
    }
}