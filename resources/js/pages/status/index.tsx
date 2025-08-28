import React from 'react';
import { Head } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Separator } from '@/components/ui/separator';

interface ComponentGroup {
    id: number;
    name: string;
    description: string | null;
    is_expanded: boolean;
    components: Component[];
}

interface Component {
    id: number;
    name: string;
    description: string | null;
    status: 'operational' | 'degraded' | 'partial_outage' | 'major_outage';
}

interface Incident {
    id: number;
    title: string;
    description: string;
    status: 'investigating' | 'identified' | 'monitoring' | 'resolved';
    impact: 'none' | 'minor' | 'major' | 'critical';
    started_at: string;
    resolved_at: string | null;
    components: Component[];
    updates: IncidentUpdate[];
}

interface IncidentUpdate {
    id: number;
    message: string;
    status: string;
    created_at: string;
}

interface MaintenanceWindow {
    id: number;
    title: string;
    description: string;
    status: 'scheduled' | 'in_progress' | 'completed';
    scheduled_start: string;
    scheduled_end: string;
    actual_start: string | null;
    actual_end: string | null;
    components: Component[];
}

interface Props {
    componentGroups: ComponentGroup[];
    activeIncidents: Incident[];
    recentIncidents: Incident[];
    upcomingMaintenance: MaintenanceWindow[];
    inProgressMaintenance: MaintenanceWindow[];
    overallStatus: 'operational' | 'issues' | 'minor' | 'major' | 'critical';
    [key: string]: unknown;
}

const statusConfig = {
    operational: {
        color: 'bg-green-500',
        text: 'text-green-600',
        bgLight: 'bg-green-50',
        borderLight: 'border-green-200',
        label: 'Operational'
    },
    degraded: {
        color: 'bg-yellow-500',
        text: 'text-yellow-600',
        bgLight: 'bg-yellow-50',
        borderLight: 'border-yellow-200',
        label: 'Degraded Performance'
    },
    partial_outage: {
        color: 'bg-orange-500',
        text: 'text-orange-600',
        bgLight: 'bg-orange-50',
        borderLight: 'border-orange-200',
        label: 'Partial Outage'
    },
    major_outage: {
        color: 'bg-red-500',
        text: 'text-red-600',
        bgLight: 'bg-red-50',
        borderLight: 'border-red-200',
        label: 'Major Outage'
    }
};

const overallStatusConfig = {
    operational: {
        color: 'bg-green-500',
        text: 'text-green-600',
        label: 'All Systems Operational'
    },
    issues: {
        color: 'bg-yellow-500',
        text: 'text-yellow-600',
        label: 'Some Systems Experiencing Issues'
    },
    minor: {
        color: 'bg-yellow-500',
        text: 'text-yellow-600',
        label: 'Minor Service Issues'
    },
    major: {
        color: 'bg-orange-500',
        text: 'text-orange-600',
        label: 'Major Service Issues'
    },
    critical: {
        color: 'bg-red-500',
        text: 'text-red-600',
        label: 'Critical Service Issues'
    }
};

const impactConfig = {
    none: { label: 'No Impact', color: 'bg-gray-500' },
    minor: { label: 'Minor Impact', color: 'bg-yellow-500' },
    major: { label: 'Major Impact', color: 'bg-orange-500' },
    critical: { label: 'Critical Impact', color: 'bg-red-500' }
};

export default function StatusIndex({
    componentGroups,
    activeIncidents,
    recentIncidents,
    upcomingMaintenance,
    inProgressMaintenance,
    overallStatus
}: Props) {
    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleString();
    };

    const getTimeDiff = (dateString: string) => {
        const diff = Date.now() - new Date(dateString).getTime();
        const minutes = Math.floor(diff / 60000);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);
        
        if (days > 0) return `${days}d ago`;
        if (hours > 0) return `${hours}h ago`;
        if (minutes > 0) return `${minutes}m ago`;
        return 'Just now';
    };

    const overallConfig = overallStatusConfig[overallStatus];

    return (
        <div className="min-h-screen bg-gray-50">
            <Head title="System Status" />
            
            {/* Header */}
            <div className="bg-white shadow-sm border-b">
                <div className="container mx-auto px-4 py-6">
                    <div className="flex items-center justify-between">
                        <div>
                            <h1 className="text-3xl font-bold text-gray-900">System Status</h1>
                            <p className="text-gray-600 mt-1">Current status of all services</p>
                        </div>
                        <div className="flex items-center space-x-3">
                            <div className={`w-3 h-3 ${overallConfig.color} rounded-full`}></div>
                            <span className={`font-medium ${overallConfig.text}`}>
                                {overallConfig.label}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div className="container mx-auto px-4 py-8 space-y-8">
                {/* Active Incidents */}
                {activeIncidents.length > 0 && (
                    <Card className="border-l-4 border-l-red-500">
                        <CardHeader>
                            <CardTitle className="flex items-center space-x-2">
                                <span className="text-red-600">🚨</span>
                                <span>Active Incidents</span>
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-6">
                            {activeIncidents.map((incident) => (
                                <div key={incident.id} className="space-y-4">
                                    <div className="flex items-start justify-between">
                                        <div className="flex-1">
                                            <div className="flex items-center space-x-3 mb-2">
                                                <h3 className="font-semibold text-lg text-gray-900">
                                                    {incident.title}
                                                </h3>
                                                <Badge variant="destructive">
                                                    {incident.status.charAt(0).toUpperCase() + incident.status.slice(1)}
                                                </Badge>
                                                <div className="flex items-center space-x-2">
                                                    <div className={`w-2 h-2 ${impactConfig[incident.impact].color} rounded-full`}></div>
                                                    <span className="text-sm text-gray-600">
                                                        {impactConfig[incident.impact].label}
                                                    </span>
                                                </div>
                                            </div>
                                            <p className="text-gray-600 mb-3">{incident.description}</p>
                                            {incident.components.length > 0 && (
                                                <div className="flex flex-wrap gap-2 mb-4">
                                                    <span className="text-sm text-gray-500">Affected components:</span>
                                                    {incident.components.map((component) => (
                                                        <Badge key={component.id} variant="outline">
                                                            {component.name}
                                                        </Badge>
                                                    ))}
                                                </div>
                                            )}
                                            <p className="text-sm text-gray-500">
                                                Started {getTimeDiff(incident.started_at)}
                                            </p>
                                        </div>
                                    </div>

                                    {incident.updates.length > 0 && (
                                        <div className="space-y-3 pl-4 border-l-2 border-gray-200">
                                            <h4 className="font-medium text-gray-900">Updates</h4>
                                            {incident.updates.map((update) => (
                                                <div key={update.id} className="space-y-1">
                                                    <div className="flex items-center space-x-2">
                                                        <Badge variant="outline" className="text-xs">
                                                            {update.status.charAt(0).toUpperCase() + update.status.slice(1)}
                                                        </Badge>
                                                        <span className="text-sm text-gray-500">
                                                            {getTimeDiff(update.created_at)}
                                                        </span>
                                                    </div>
                                                    <p className="text-sm text-gray-700">{update.message}</p>
                                                </div>
                                            ))}
                                        </div>
                                    )}
                                    <Separator />
                                </div>
                            ))}
                        </CardContent>
                    </Card>
                )}

                {/* In Progress Maintenance */}
                {inProgressMaintenance.length > 0 && (
                    <Card className="border-l-4 border-l-yellow-500">
                        <CardHeader>
                            <CardTitle className="flex items-center space-x-2">
                                <span className="text-yellow-600">🔧</span>
                                <span>Maintenance in Progress</span>
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-4">
                            {inProgressMaintenance.map((maintenance) => (
                                <div key={maintenance.id} className="space-y-2">
                                    <h3 className="font-semibold text-lg text-gray-900">{maintenance.title}</h3>
                                    <p className="text-gray-600">{maintenance.description}</p>
                                    <div className="flex items-center space-x-4 text-sm text-gray-500">
                                        <span>Started: {formatDate(maintenance.scheduled_start)}</span>
                                        <span>Expected End: {formatDate(maintenance.scheduled_end)}</span>
                                    </div>
                                    {maintenance.components.length > 0 && (
                                        <div className="flex flex-wrap gap-2">
                                            <span className="text-sm text-gray-500">Affected components:</span>
                                            {maintenance.components.map((component) => (
                                                <Badge key={component.id} variant="outline">
                                                    {component.name}
                                                </Badge>
                                            ))}
                                        </div>
                                    )}
                                </div>
                            ))}
                        </CardContent>
                    </Card>
                )}

                {/* Component Status */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center space-x-2">
                            <span>⚙️</span>
                            <span>System Components</span>
                        </CardTitle>
                    </CardHeader>
                    <CardContent className="space-y-8">
                        {componentGroups.map((group) => (
                            <div key={group.id} className="space-y-4">
                                <div>
                                    <h3 className="font-semibold text-lg text-gray-900 mb-1">
                                        {group.name}
                                    </h3>
                                    {group.description && (
                                        <p className="text-gray-600 text-sm">{group.description}</p>
                                    )}
                                </div>
                                <div className="space-y-2">
                                    {group.components.map((component) => {
                                        const config = statusConfig[component.status];
                                        return (
                                            <div
                                                key={component.id}
                                                className={`flex items-center justify-between p-4 rounded-lg border ${config.bgLight} ${config.borderLight}`}
                                            >
                                                <div>
                                                    <h4 className="font-medium text-gray-900">{component.name}</h4>
                                                    {component.description && (
                                                        <p className="text-sm text-gray-600">{component.description}</p>
                                                    )}
                                                </div>
                                                <div className="flex items-center space-x-2">
                                                    <div className={`w-3 h-3 ${config.color} rounded-full`}></div>
                                                    <span className={`text-sm font-medium ${config.text}`}>
                                                        {config.label}
                                                    </span>
                                                </div>
                                            </div>
                                        );
                                    })}
                                </div>
                            </div>
                        ))}
                    </CardContent>
                </Card>

                {/* Upcoming Maintenance */}
                {upcomingMaintenance.length > 0 && (
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center space-x-2">
                                <span>📅</span>
                                <span>Scheduled Maintenance</span>
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-4">
                            {upcomingMaintenance.map((maintenance) => (
                                <div key={maintenance.id} className="space-y-2 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                    <h3 className="font-semibold text-lg text-gray-900">{maintenance.title}</h3>
                                    <p className="text-gray-600">{maintenance.description}</p>
                                    <div className="flex items-center space-x-4 text-sm text-gray-500">
                                        <span>Start: {formatDate(maintenance.scheduled_start)}</span>
                                        <span>End: {formatDate(maintenance.scheduled_end)}</span>
                                    </div>
                                    {maintenance.components.length > 0 && (
                                        <div className="flex flex-wrap gap-2">
                                            <span className="text-sm text-gray-500">Affected components:</span>
                                            {maintenance.components.map((component) => (
                                                <Badge key={component.id} variant="outline">
                                                    {component.name}
                                                </Badge>
                                            ))}
                                        </div>
                                    )}
                                </div>
                            ))}
                        </CardContent>
                    </Card>
                )}

                {/* Recent Incidents */}
                {recentIncidents.length > 0 && (
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center space-x-2">
                                <span>📝</span>
                                <span>Recent Incidents</span>
                            </CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-4">
                            {recentIncidents.map((incident) => (
                                <div key={incident.id} className="space-y-2 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                    <div className="flex items-center justify-between">
                                        <h3 className="font-semibold text-gray-900">{incident.title}</h3>
                                        <Badge variant="outline" className="text-green-600 border-green-200">
                                            Resolved
                                        </Badge>
                                    </div>
                                    <p className="text-gray-600 text-sm">{incident.description}</p>
                                    <div className="flex items-center space-x-4 text-sm text-gray-500">
                                        <span>Duration: {getTimeDiff(incident.started_at)} - {incident.resolved_at && getTimeDiff(incident.resolved_at)}</span>
                                        <div className="flex items-center space-x-2">
                                            <div className={`w-2 h-2 ${impactConfig[incident.impact].color} rounded-full`}></div>
                                            <span>{impactConfig[incident.impact].label}</span>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </CardContent>
                    </Card>
                )}
            </div>
        </div>
    );
}