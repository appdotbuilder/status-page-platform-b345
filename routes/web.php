<?php

use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ComponentGroupController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\IncidentUpdateController;
use App\Http\Controllers\MaintenanceWindowController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

// Public status page
Route::get('/status', [StatusController::class, 'index'])->name('status.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    // Component Groups Management
    Route::resource('component-groups', ComponentGroupController::class);

    // Components Management
    Route::resource('components', ComponentController::class);

    // Incidents Management
    Route::resource('incidents', IncidentController::class);
    
    // Incident Updates
    Route::post('incidents/{incident}/updates', [IncidentUpdateController::class, 'store'])
        ->name('incident-updates.store');
    Route::delete('incidents/{incident}/updates/{incidentUpdate}', [IncidentUpdateController::class, 'destroy'])
        ->name('incident-updates.destroy');

    // Maintenance Windows
    Route::resource('maintenance', MaintenanceWindowController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
