<?php

namespace Database\Seeders;

use App\Models\Component;
use App\Models\ComponentGroup;
use App\Models\Incident;
use App\Models\IncidentUpdate;
use App\Models\MaintenanceWindow;
use Illuminate\Database\Seeder;

class StatusPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Component Groups
        $coreServices = ComponentGroup::create([
            'name' => 'Core Services',
            'description' => 'Essential services that power our platform',
            'sort_order' => 1,
            'is_expanded' => true,
        ]);

        $thirdPartyServices = ComponentGroup::create([
            'name' => 'Third Party Services',
            'description' => 'External services we depend on',
            'sort_order' => 2,
            'is_expanded' => true,
        ]);

        $infrastructure = ComponentGroup::create([
            'name' => 'Infrastructure',
            'description' => 'Core infrastructure components',
            'sort_order' => 3,
            'is_expanded' => true,
        ]);

        // Create Components for Core Services
        $apiGateway = Component::create([
            'component_group_id' => $coreServices->id,
            'name' => 'API Gateway',
            'description' => 'Main API endpoint for all requests',
            'status' => 'operational',
            'sort_order' => 1,
        ]);

        $webApp = Component::create([
            'component_group_id' => $coreServices->id,
            'name' => 'Web Application',
            'description' => 'Main web interface',
            'status' => 'degraded',
            'sort_order' => 2,
        ]);

        $mobileApp = Component::create([
            'component_group_id' => $coreServices->id,
            'name' => 'Mobile Application',
            'description' => 'iOS and Android applications',
            'status' => 'operational',
            'sort_order' => 3,
        ]);

        // Create Components for Third Party Services
        $paymentProcessing = Component::create([
            'component_group_id' => $thirdPartyServices->id,
            'name' => 'Payment Processing',
            'description' => 'Credit card and payment processing',
            'status' => 'operational',
            'sort_order' => 1,
        ]);

        $emailService = Component::create([
            'component_group_id' => $thirdPartyServices->id,
            'name' => 'Email Service',
            'description' => 'Transactional and marketing emails',
            'status' => 'operational',
            'sort_order' => 2,
        ]);

        $pushNotifications = Component::create([
            'component_group_id' => $thirdPartyServices->id,
            'name' => 'Push Notifications',
            'description' => 'Mobile push notification service',
            'status' => 'operational',
            'sort_order' => 3,
        ]);

        // Create Components for Infrastructure
        $database = Component::create([
            'component_group_id' => $infrastructure->id,
            'name' => 'Primary Database',
            'description' => 'Main PostgreSQL database cluster',
            'status' => 'operational',
            'sort_order' => 1,
        ]);

        $redis = Component::create([
            'component_group_id' => $infrastructure->id,
            'name' => 'Cache Layer',
            'description' => 'Redis caching system',
            'status' => 'operational',
            'sort_order' => 2,
        ]);

        $cdn = Component::create([
            'component_group_id' => $infrastructure->id,
            'name' => 'CDN',
            'description' => 'Content delivery network',
            'status' => 'operational',
            'sort_order' => 3,
        ]);

        // Create a current incident for Web Application
        $currentIncident = Incident::create([
            'title' => 'Slow Response Times on Web Application',
            'description' => 'Users may experience slower than normal response times when loading pages. Our team is investigating the cause.',
            'status' => 'monitoring',
            'impact' => 'minor',
            'started_at' => now()->subHours(2),
            'resolved_at' => null,
        ]);

        // Attach the web app component to the incident
        $currentIncident->components()->attach([$webApp->id]);

        // Create incident updates
        IncidentUpdate::create([
            'incident_id' => $currentIncident->id,
            'message' => 'We have identified the issue as high CPU usage on our web servers. We are working to resolve this.',
            'status' => 'identified',
            'created_at' => now()->subMinutes(45),
        ]);

        IncidentUpdate::create([
            'incident_id' => $currentIncident->id,
            'message' => 'We have deployed additional server capacity and are monitoring the situation. Response times are improving.',
            'status' => 'monitoring',
            'created_at' => now()->subMinutes(15),
        ]);

        // Create a resolved incident
        $resolvedIncident = Incident::create([
            'title' => 'Database Connection Issues',
            'description' => 'Brief database connectivity issues caused some requests to fail.',
            'status' => 'resolved',
            'impact' => 'major',
            'started_at' => now()->subDays(2)->subHours(1),
            'resolved_at' => now()->subDays(2)->addMinutes(45),
        ]);

        $resolvedIncident->components()->attach([$database->id, $apiGateway->id]);

        IncidentUpdate::create([
            'incident_id' => $resolvedIncident->id,
            'message' => 'We are investigating reports of database connection timeouts.',
            'status' => 'investigating',
            'created_at' => now()->subDays(2)->subHours(1),
        ]);

        IncidentUpdate::create([
            'incident_id' => $resolvedIncident->id,
            'message' => 'We have identified the issue as a network configuration problem and are working on a fix.',
            'status' => 'identified',
            'created_at' => now()->subDays(2)->subMinutes(30),
        ]);

        IncidentUpdate::create([
            'incident_id' => $resolvedIncident->id,
            'message' => 'The network configuration has been corrected and all services are now operational.',
            'status' => 'resolved',
            'created_at' => now()->subDays(2)->addMinutes(45),
        ]);

        // Create upcoming maintenance
        $upcomingMaintenance = MaintenanceWindow::create([
            'title' => 'Database Maintenance Window',
            'description' => 'Scheduled maintenance to upgrade our database servers. We expect minimal impact to users.',
            'status' => 'scheduled',
            'scheduled_start' => now()->addDays(3)->setHour(2)->setMinute(0),
            'scheduled_end' => now()->addDays(3)->setHour(4)->setMinute(0),
        ]);

        $upcomingMaintenance->components()->attach([$database->id, $apiGateway->id]);

        // Create another maintenance for next week
        $weeklyMaintenance = MaintenanceWindow::create([
            'title' => 'Weekly Security Updates',
            'description' => 'Routine security updates and patches will be applied to our infrastructure.',
            'status' => 'scheduled',
            'scheduled_start' => now()->addWeek()->setHour(1)->setMinute(0),
            'scheduled_end' => now()->addWeek()->setHour(3)->setMinute(0),
        ]);

        $weeklyMaintenance->components()->attach([$infrastructure->components->pluck('id')->toArray()]);

        // Create a completed maintenance from last week
        $completedMaintenance = MaintenanceWindow::create([
            'title' => 'CDN Configuration Update',
            'description' => 'Updated CDN configuration for improved performance.',
            'status' => 'completed',
            'scheduled_start' => now()->subWeek()->setHour(2)->setMinute(0),
            'scheduled_end' => now()->subWeek()->setHour(3)->setMinute(0),
            'actual_start' => now()->subWeek()->setHour(2)->setMinute(5),
            'actual_end' => now()->subWeek()->setHour(2)->setMinute(45),
        ]);

        $completedMaintenance->components()->attach([$cdn->id]);
    }
}