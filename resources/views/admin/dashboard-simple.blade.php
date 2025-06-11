@extends('layouts.app.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="nxl-content-inner">
        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="page-header">
                    <div class="page-header-left">
                        <h1 class="page-title">Admin Dashboard</h1>
                        <p class="page-description">Welcome to your leads management system</p>
                    </div>
                    <div class="page-header-right">
                        <a href="{{ route('admin.leads.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Lead
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-text avatar-lg bg-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="ms-3">
                                <h4 class="mb-0">{{ $totalLeads }}</h4>
                                <p class="text-muted mb-0">Total Leads</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-text avatar-lg bg-success">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="ms-3">
                                <h4 class="mb-0">{{ $convertedLeads }}</h4>
                                <p class="text-muted mb-0">Customers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-text avatar-lg bg-warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="ms-3">
                                <h4 class="mb-0">{{ $activeLeads }}</h4>
                                <p class="text-muted mb-0">Active Leads</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-text avatar-lg bg-info">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="ms-3">
                                <h4 class="mb-0">{{ $qualifiedLeads }}</h4>
                                <p class="text-muted mb-0">Qualified</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Leads -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Recent Leads</h5>
                        <a href="{{ route('admin.leads.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body">
                        @if($recentLeads->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Company</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentLeads as $lead)
                                            <tr>
                                                <td>
                                                    <strong>{{ $lead->fullname }}</strong>
                                                </td>
                                                <td>
                                                    @if($lead->email)
                                                        <a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>{{ $lead->company ?: 'N/A' }}</td>
                                                <td>
                                                    @if($lead->status)
                                                        <span class="badge bg-info">{{ ucfirst($lead->status) }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">No Status</span>
                                                    @endif
                                                </td>
                                                <td>{{ $lead->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.leads.show', $lead) }}" class="btn btn-sm btn-outline-info">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.leads.edit', $lead) }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h5>No leads yet</h5>
                                <p class="text-muted">Start by creating your first lead</p>
                                <a href="{{ route('admin.leads.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create First Lead
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Status Distribution -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Leads by Status</h5>
                    </div>
                    <div class="card-body">
                        @if(!empty($leadsByStatus))
                            @foreach($leadsByStatus as $status => $count)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <span class="badge bg-info me-2">{{ ucfirst($status) }}</span>
                                    </div>
                                    <div>
                                        <strong>{{ $count }}</strong>
                                        <small class="text-muted">
                                            ({{ $totalLeads > 0 ? round(($count / $totalLeads) * 100, 1) : 0 }}%)
                                        </small>
                                    </div>
                                </div>
                                <div class="progress mb-3" style="height: 6px;">
                                    <div class="progress-bar bg-info" role="progressbar" 
                                         style="width: {{ $totalLeads > 0 ? ($count / $totalLeads) * 100 : 0 }}%"></div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-chart-pie fa-2x text-muted mb-3"></i>
                                <p class="text-muted">No status data available</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.leads.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Lead
                            </a>
                            <a href="{{ route('admin.leads.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-list"></i> View All Leads
                            </a>
                            <a href="{{ route('admin.leads.index', ['status' => 'new']) }}" class="btn btn-outline-warning">
                                <i class="fas fa-star"></i> View New Leads
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 