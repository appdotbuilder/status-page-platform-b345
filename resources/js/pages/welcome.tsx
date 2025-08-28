import React from 'react';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';

export default function Welcome() {
    return (
        <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50">
            {/* Header */}
            <header className="border-b bg-white/80 backdrop-blur-sm">
                <div className="container mx-auto px-4 py-4 flex justify-between items-center">
                    <div className="flex items-center space-x-2">
                        <div className="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                            <span className="text-white font-bold text-sm">📊</span>
                        </div>
                        <h1 className="text-xl font-bold text-gray-900">StatusBoard</h1>
                    </div>
                    <div className="flex items-center space-x-4">
                        <Link href="/login">
                            <Button variant="ghost">Login</Button>
                        </Link>
                        <Link href="/register">
                            <Button>Get Started</Button>
                        </Link>
                    </div>
                </div>
            </header>

            {/* Hero Section */}
            <section className="py-20 px-4">
                <div className="container mx-auto text-center max-w-4xl">
                    <div className="mb-6">
                        <Badge variant="secondary" className="mb-4">
                            🚀 Professional Status Page Platform
                        </Badge>
                    </div>
                    <h2 className="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Keep Your Users <span className="text-green-600">Informed</span><br />
                        When It Matters Most
                    </h2>
                    <p className="text-xl text-gray-600 mb-8 leading-relaxed">
                        Build trust with your customers through transparent communication. 
                        Monitor system health, manage incidents, and schedule maintenance windows 
                        with our comprehensive status page platform.
                    </p>
                    <div className="flex justify-center space-x-4">
                        <Link href="/register">
                            <Button size="lg" className="px-8 py-3">
                                Start Free Trial
                            </Button>
                        </Link>
                        <Link href="/status">
                            <Button variant="outline" size="lg" className="px-8 py-3">
                                View Demo Status Page
                            </Button>
                        </Link>
                    </div>
                </div>
            </section>

            {/* Features Grid */}
            <section className="py-16 px-4 bg-white/50">
                <div className="container mx-auto max-w-6xl">
                    <div className="text-center mb-12">
                        <h3 className="text-3xl font-bold text-gray-900 mb-4">
                            Everything You Need for Status Communication
                        </h3>
                        <p className="text-gray-600 max-w-2xl mx-auto">
                            From system monitoring to incident management, our platform provides 
                            all the tools you need to maintain transparency with your users.
                        </p>
                    </div>

                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <Card className="border-0 shadow-lg hover:shadow-xl transition-shadow">
                            <CardHeader>
                                <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">🏗️</span>
                                </div>
                                <CardTitle>Component Management</CardTitle>
                                <CardDescription>
                                    Organize your services into logical component groups for clear status visualization
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="space-y-2 text-sm text-gray-600">
                                    <li>• Create component groups</li>
                                    <li>• Track individual service status</li>
                                    <li>• Real-time status updates</li>
                                    <li>• Custom status indicators</li>
                                </ul>
                            </CardContent>
                        </Card>

                        <Card className="border-0 shadow-lg hover:shadow-xl transition-shadow">
                            <CardHeader>
                                <div className="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">🚨</span>
                                </div>
                                <CardTitle>Incident Management</CardTitle>
                                <CardDescription>
                                    Report, track, and communicate about service incidents effectively
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="space-y-2 text-sm text-gray-600">
                                    <li>• Create and manage incidents</li>
                                    <li>• Real-time status updates</li>
                                    <li>• Impact level tracking</li>
                                    <li>• Timeline of events</li>
                                </ul>
                            </CardContent>
                        </Card>

                        <Card className="border-0 shadow-lg hover:shadow-xl transition-shadow">
                            <CardHeader>
                                <div className="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">🔧</span>
                                </div>
                                <CardTitle>Maintenance Windows</CardTitle>
                                <CardDescription>
                                    Schedule and communicate planned maintenance to your users
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="space-y-2 text-sm text-gray-600">
                                    <li>• Schedule maintenance</li>
                                    <li>• Automated notifications</li>
                                    <li>• Component-specific updates</li>
                                    <li>• Progress tracking</li>
                                </ul>
                            </CardContent>
                        </Card>

                        <Card className="border-0 shadow-lg hover:shadow-xl transition-shadow">
                            <CardHeader>
                                <div className="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">📈</span>
                                </div>
                                <CardTitle>Real-time Updates</CardTitle>
                                <CardDescription>
                                    Keep users informed with live status updates and notifications
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="space-y-2 text-sm text-gray-600">
                                    <li>• Live status dashboard</li>
                                    <li>• Incident update timeline</li>
                                    <li>• Status change notifications</li>
                                    <li>• Historical data tracking</li>
                                </ul>
                            </CardContent>
                        </Card>

                        <Card className="border-0 shadow-lg hover:shadow-xl transition-shadow">
                            <CardHeader>
                                <div className="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">🎨</span>
                                </div>
                                <CardTitle>Professional Design</CardTitle>
                                <CardDescription>
                                    Beautiful, responsive status pages that match your brand
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="space-y-2 text-sm text-gray-600">
                                    <li>• Mobile-responsive design</li>
                                    <li>• Clean, professional look</li>
                                    <li>• Color-coded status indicators</li>
                                    <li>• Easy-to-read layouts</li>
                                </ul>
                            </CardContent>
                        </Card>

                        <Card className="border-0 shadow-lg hover:shadow-xl transition-shadow">
                            <CardHeader>
                                <div className="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">⚡</span>
                                </div>
                                <CardTitle>Easy Management</CardTitle>
                                <CardDescription>
                                    Intuitive admin interface for managing all aspects of your status page
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <ul className="space-y-2 text-sm text-gray-600">
                                    <li>• Simple admin dashboard</li>
                                    <li>• Quick status updates</li>
                                    <li>• Bulk component management</li>
                                    <li>• User-friendly interface</li>
                                </ul>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </section>

            {/* Status Demo Preview */}
            <section className="py-16 px-4">
                <div className="container mx-auto max-w-4xl">
                    <div className="text-center mb-12">
                        <h3 className="text-3xl font-bold text-gray-900 mb-4">
                            See It In Action
                        </h3>
                        <p className="text-gray-600">
                            Here's what your status page could look like
                        </p>
                    </div>

                    <div className="bg-white rounded-lg shadow-xl border p-8">
                        <div className="flex items-center justify-between mb-8">
                            <div>
                                <h4 className="text-2xl font-bold text-gray-900">System Status</h4>
                                <p className="text-gray-600">All systems operational</p>
                            </div>
                            <div className="flex items-center space-x-2">
                                <div className="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span className="text-sm text-green-600 font-medium">Operational</span>
                            </div>
                        </div>

                        <div className="space-y-6">
                            <div>
                                <h5 className="font-semibold text-gray-900 mb-3">Core Services</h5>
                                <div className="space-y-2">
                                    <div className="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span className="text-gray-700">API Gateway</span>
                                        <div className="flex items-center space-x-2">
                                            <div className="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span className="text-sm text-green-600">Operational</span>
                                        </div>
                                    </div>
                                    <div className="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span className="text-gray-700">Database</span>
                                        <div className="flex items-center space-x-2">
                                            <div className="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span className="text-sm text-green-600">Operational</span>
                                        </div>
                                    </div>
                                    <div className="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span className="text-gray-700">Web Application</span>
                                        <div className="flex items-center space-x-2">
                                            <div className="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                            <span className="text-sm text-yellow-600">Degraded Performance</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h5 className="font-semibold text-gray-900 mb-3">Third Party Services</h5>
                                <div className="space-y-2">
                                    <div className="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span className="text-gray-700">Payment Processing</span>
                                        <div className="flex items-center space-x-2">
                                            <div className="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span className="text-sm text-green-600">Operational</span>
                                        </div>
                                    </div>
                                    <div className="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span className="text-gray-700">Email Service</span>
                                        <div className="flex items-center space-x-2">
                                            <div className="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span className="text-sm text-green-600">Operational</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* CTA Section */}
            <section className="py-20 px-4 bg-gradient-to-r from-green-600 to-blue-600 text-white">
                <div className="container mx-auto text-center max-w-3xl">
                    <h3 className="text-4xl font-bold mb-6">
                        Ready to Build Trust with Your Users?
                    </h3>
                    <p className="text-xl opacity-90 mb-8">
                        Start communicating transparently about your service status. 
                        Your users will thank you for the visibility.
                    </p>
                    <div className="flex justify-center space-x-4">
                        <Link href="/register">
                            <Button size="lg" variant="secondary" className="px-8 py-3">
                                Start Your Status Page
                            </Button>
                        </Link>
                        <Link href="/status">
                            <Button size="lg" variant="outline" className="px-8 py-3 border-white text-white hover:bg-white hover:text-gray-900">
                                View Live Demo
                            </Button>
                        </Link>
                    </div>
                </div>
            </section>

            {/* Footer */}
            <footer className="py-8 px-4 bg-gray-900 text-gray-300">
                <div className="container mx-auto text-center">
                    <div className="flex items-center justify-center space-x-2 mb-4">
                        <div className="w-6 h-6 bg-green-500 rounded flex items-center justify-center">
                            <span className="text-white text-xs">📊</span>
                        </div>
                        <span className="font-bold">StatusBoard</span>
                    </div>
                    <p className="text-sm">
                        © 2024 StatusBoard. Built for transparency and reliability.
                    </p>
                </div>
            </footer>
        </div>
    );
}