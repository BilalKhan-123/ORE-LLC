@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Dashboard</h1>
            </div>
            {{-- <div class="col-md-4 text-end">
                <a target="_blank" href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">View Site</a>
            </div> --}}
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-2 mb-3">
                <div class="card stat-card border-start border-secondary border-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Departments</h6>
                                <h3 class="mb-0">{{ $stats['departments'] }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-light">
                                <i class="fas fa-sitemap fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 mb-3">
                <div class="card stat-card border-start border-secondary border-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Services</h6>
                                <h3 class="mb-0">{{ $stats['services'] }}</h3>
                            </div>
                            <div class="stat-icon bg-success-light">
                                <i class="fas fa-concierge-bell fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 mb-3">
                <div class="card stat-card border-start border-secondary border-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Banners</h6>
                                <h3 class="mb-0">{{ $stats['banners'] }}</h3>
                            </div>
                            <div class="stat-icon bg-warning-light">
                                <i class="fas fa-image fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 mb-3">
                <div class="card stat-card border-start border-secondary border-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">FAQs</h6>
                                <h3 class="mb-0">{{ $stats['faqs'] }}</h3>
                            </div>
                            <div class="stat-icon bg-info-light">
                                <i class="fas fa-question-circle fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-2 mb-3">
                <div class="card stat-card border-start border-secondary border-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Testimonials</h6>
                                <h3 class="mb-0">{{ $stats['testimonials'] }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-light">
                                <i class="fas fa-comments fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col-md-2 mb-3">
                <div class="card stat-card border-start border-secondary border-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Galleries</h6>
                                <h3 class="mb-0">{{ $stats['galleries'] }}</h3>
                            </div>
                            <div class="stat-icon bg-secondary-light">
                                <i class="fas fa-photo-video fa-2x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Contacts & Testimonials -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-address-book text-success"></i> Recent Contacts
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        @forelse($recentContacts as $contact)
                            <div class="border-bottom p-3">
                                <h6 class="mb-1">{{ $contact->name }}</h6>
                                <small class="text-muted d-block">{{ $contact->email }}</small>
                                <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                            </div>
                        @empty
                            <div class="p-3 text-center text-muted">
                                No contacts yet
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-comments text-danger"></i> Recent Testimonials
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        @forelse($recentTestimonials as $testimonial)
                            <div class="border-bottom p-3">
                                <h6 class="mb-1">{{ $testimonial->name }}</h6>
                                <small class="text-muted d-block">{{ Str::limit($testimonial->description ?? '', 80) }}</small>
                                <small class="text-muted">{{ $testimonial->created_at->diffForHumans() }}</small>
                            </div>
                        @empty
                            <div class="p-3 text-center text-muted">
                                No testimonials yet
                            </div>
                        @endforelse
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- Charts Section -->
        {{-- <div class="row mb-4">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Content Overview</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="contentChart"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}

        
    </div>

    <style>
        .stat-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-primary-light {
            background-color: rgba(0, 123, 255, 0.1);
        }

        .bg-success-light {
            background-color: rgba(40, 167, 69, 0.1);
        }

        .bg-warning-light {
            background-color: rgba(255, 193, 7, 0.1);
        }

        .bg-info-light {
            background-color: rgba(23, 162, 184, 0.1);
        }

        .bg-danger-light {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .bg-secondary-light {
            background-color: rgba(108, 117, 125, 0.1);
        }

        .bg-dark-light {
            background-color: rgba(33, 37, 41, 0.1);
        }

        .card-header {
            border-bottom: 1px solid #e0e0e0;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Content Overview Bar Chart
            const contentCtx = document.getElementById('contentChart')?.getContext('2d');
            if (contentCtx) {
                new Chart(contentCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Departments', 'Services', 'Banners', 'FAQs', 'Testimonials', 'Galleries'],
                        datasets: [{
                            label: 'Content Count',
                            data: [
                                {{ $stats['departments'] }},
                                {{ $stats['services'] }},
                                {{ $stats['banners'] }},
                                {{ $stats['faqs'] }},
                                {{ $stats['testimonials'] }},
                                {{ $stats['galleries'] }},

                            ],
                            backgroundColor: [
                                'rgba(0, 123, 255, 0.8)',
                                'rgba(40, 167, 69, 0.8)',
                                'rgba(255, 193, 7, 0.8)',
                                'rgba(23, 162, 184, 0.8)',
                                'rgba(220, 53, 69, 0.8)',
                                'rgba(108, 117, 125, 0.8)',
                                'rgba(33, 37, 41, 0.8)'
                            ],
                            borderColor: [
                                'rgba(0, 123, 255, 1)',
                                'rgba(40, 167, 69, 1)',
                                'rgba(255, 193, 7, 1)',
                                'rgba(23, 162, 184, 1)',
                                'rgba(220, 53, 69, 1)',
                                'rgba(108, 117, 125, 1)',
                                'rgba(33, 37, 41, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }

            // Distribution Pie Chart
            const distributionCtx = document.getElementById('distributionChart')?.getContext('2d');
            if (distributionCtx) {
                new Chart(distributionCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Departments', 'Services', 'Banners', 'FAQs', 'Testimonials', 'Galleries', 'About'],
                        datasets: [{
                            data: [
                                {{ $stats['departments'] }},
                                {{ $stats['services'] }},
                                {{ $stats['banners'] }},
                                {{ $stats['faqs'] }},
                                {{ $stats['testimonials'] }},
                                {{ $stats['galleries'] }},
                                {{ $stats['abouts'] }}
                            ],
                            backgroundColor: [
                                'rgba(0, 123, 255, 0.8)',
                                'rgba(40, 167, 69, 0.8)',
                                'rgba(255, 193, 7, 0.8)',
                                'rgba(23, 162, 184, 0.8)',
                                'rgba(220, 53, 69, 0.8)',
                                'rgba(108, 117, 125, 0.8)',
                                'rgba(33, 37, 41, 0.8)'
                            ],
                            borderColor: '#fff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
