import React from 'react';
import { Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 overflow-x-auto">
                <div>
                    <h1 className="text-3xl font-bold text-gray-900 mb-2">
                        📊 Status Page Dashboard
                    </h1>
                    <p className="text-gray-600">
                        Manage your system components, incidents, and maintenance windows
                    </p>
                </div>

                {/* Quick Actions */}
                <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <Card className="hover:shadow-lg transition-shadow">
                        <CardHeader className="pb-3">
                            <CardTitle className="text-lg flex items-center space-x-2">
                                <span className="text-2xl">🏗️</span>
                                <span>Components</span>
                            </CardTitle>
                            <CardDescription>
                                Manage system components and groups
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-3">
                            <div className="space-y-2">
                                <Link href="/component-groups">
                                    <Button variant="outline" className="w-full">
                                        Component Groups
                                    </Button>
                                </Link>
                                <Link href="/components">
                                    <Button variant="outline" className="w-full">
                                        Components
                                    </Button>
                                </Link>
                            </div>
                        </CardContent>
                    </Card>

                    <Card className="hover:shadow-lg transition-shadow">
                        <CardHeader className="pb-3">
                            <CardTitle className="text-lg flex items-center space-x-2">
                                <span className="text-2xl">🚨</span>
                                <span>Incidents</span>
                            </CardTitle>
                            <CardDescription>
                                Report and manage service incidents
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-3">
                            <Link href="/incidents/create">
                                <Button className="w-full">
                                    Report Incident
                                </Button>
                            </Link>
                            <Link href="/incidents">
                                <Button variant="outline" className="w-full">
                                    View All Incidents
                                </Button>
                            </Link>
                        </CardContent>
                    </Card>

                    <Card className="hover:shadow-lg transition-shadow">
                        <CardHeader className="pb-3">
                            <CardTitle className="text-lg flex items-center space-x-2">
                                <span className="text-2xl">🔧</span>
                                <span>Maintenance</span>
                            </CardTitle>
                            <CardDescription>
                                Schedule and track maintenance windows
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-3">
                            <Link href="/maintenance/create">
                                <Button className="w-full">
                                    Schedule Maintenance
                                </Button>
                            </Link>
                            <Link href="/maintenance">
                                <Button variant="outline" className="w-full">
                                    View All Maintenance
                                </Button>
                            </Link>
                        </CardContent>
                    </Card>

                    <Card className="hover:shadow-lg transition-shadow">
                        <CardHeader className="pb-3">
                            <CardTitle className="text-lg flex items-center space-x-2">
                                <span className="text-2xl">📊</span>
                                <span>Status Page</span>
                            </CardTitle>
                            <CardDescription>
                                View and manage your public status page
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-3">
                            <Link href="/status">
                                <Button className="w-full">
                                    View Public Status
                                </Button>
                            </Link>
                            <Button variant="outline" className="w-full" disabled>
                                Settings (Coming Soon)
                            </Button>
                        </CardContent>
                    </Card>
                </div>

                {/* Getting Started */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center space-x-2">
                            <span>📈</span>
                            <span>Getting Started</span>
                        </CardTitle>
                        <CardDescription>
                            Quick steps to set up your status page
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="space-y-4">
                            <div className="flex items-start space-x-3">
                                <div className="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-sm font-bold">
                                    1
                                </div>
                                <div>
                                    <h4 className="font-medium text-gray-900">Create Component Groups</h4>
                                    <p className="text-sm text-gray-600">
                                        Organize your services into logical groups (e.g., Core Services, Third Party Services)
                                    </p>
                                    <Link href="/component-groups/create" className="mt-2 inline-block">
                                        <Button variant="outline" size="sm">
                                            Create Component Group
                                        </Button>
                                    </Link>
                                </div>
                            </div>

                            <div className="flex items-start space-x-3">
                                <div className="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-bold">
                                    2
                                </div>
                                <div>
                                    <h4 className="font-medium text-gray-900">Add Components</h4>
                                    <p className="text-sm text-gray-600">
                                        Add individual services and components to track their status
                                    </p>
                                    <Link href="/components/create" className="mt-2 inline-block">
                                        <Button variant="outline" size="sm">
                                            Add Component
                                        </Button>
                                    </Link>
                                </div>
                            </div>

                            <div className="flex items-start space-x-3">
                                <div className="w-6 h-6 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-sm font-bold">
                                    3
                                </div>
                                <div>
                                    <h4 className="font-medium text-gray-900">Test Your Status Page</h4>
                                    <p className="text-sm text-gray-600">
                                        Visit your public status page to see how it looks to your users
                                    </p>
                                    <Link href="/status" className="mt-2 inline-block">
                                        <Button variant="outline" size="sm">
                                            View Status Page
                                        </Button>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                {/* Key Features */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center space-x-2">
                            <span>⚡</span>
                            <span>Key Features</span>
                        </CardTitle>
                        <CardDescription>
                            Everything you need to maintain transparency with your users
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="grid md:grid-cols-2 gap-6">
                            <div className="space-y-4">
                                <div className="flex items-start space-x-3">
                                    <span className="text-lg">🏗️</span>
                                    <div>
                                        <h4 className="font-medium">Component Management</h4>
                                        <p className="text-sm text-gray-600">
                                            Organize services into groups and track their individual status
                                        </p>
                                    </div>
                                </div>
                                <div className="flex items-start space-x-3">
                                    <span className="text-lg">🚨</span>
                                    <div>
                                        <h4 className="font-medium">Incident Tracking</h4>
                                        <p className="text-sm text-gray-600">
                                            Report incidents and keep users informed with real-time updates
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div className="space-y-4">
                                <div className="flex items-start space-x-3">
                                    <span className="text-lg">🔧</span>
                                    <div>
                                        <h4 className="font-medium">Maintenance Windows</h4>
                                        <p className="text-sm text-gray-600">
                                            Schedule and communicate planned maintenance to users
                                        </p>
                                    </div>
                                </div>
                                <div className="flex items-start space-x-3">
                                    <span className="text-lg">📊</span>
                                    <div>
                                        <h4 className="font-medium">Professional Design</h4>
                                        <p className="text-sm text-gray-600">
                                            Clean, responsive status page that builds trust with users
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}