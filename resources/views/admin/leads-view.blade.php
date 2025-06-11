@extends('layouts.app.master')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content')


<div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Leads</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">View Lead</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="{{ route('admin.leads.index') }}" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            <a href="{{ route('admin.leads.index') }}" class="btn btn-light-brand">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back to List</span>
                            </a>
                            <a href="{{ route('admin.leads.edit', $lead->id) }}" class="btn btn-primary">
                                <i class="feather-edit me-2"></i>
                                <span>Edit Lead</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <div class="bg-white py-3 border-bottom rounded-0 p-md-0 mb-0">
                <div class="d-md-none d-flex">
                    <a href="javascript:void(0)" class="page-content-left-open-toggle">
                        <i class="feather-align-left fs-20"></i>
                    </a>
                </div>
                <!-- <div class="d-flex align-items-center justify-content-between">
                    <div class="nav-tabs-wrapper page-content-left-sidebar-wrapper">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-content-left-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                 
                    </div>
                </div> -->
            </div>
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                        <div class="card card-body lead-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0">
                                    <span class="d-block mb-2">Lead Information :</span>
                                    <span class="fs-12 fw-normal text-muted d-block">Following information for your lead</span>
                                </h5>
                                <!-- <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Create Invoice</a> -->
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Name</div>
                                <div class="col-lg-10">{{ $lead->fullname ?: 'N/A' }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Company</div>
                                <div class="col-lg-10">{{ $lead->company ?: 'N/A' }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Email</div>
                                <div class="col-lg-10">
                                    @if($lead->email)
                                        <a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Phone 1</div>
                                <div class="col-lg-10">
                                    @if($lead->phone1)
                                        <a href="tel:{{ $lead->phone1 }}">{{ $lead->phone1 }}</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            @if($lead->phone2)
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Phone 2</div>
                                <div class="col-lg-10">
                                    <a href="tel:{{ $lead->phone2 }}">{{ $lead->phone2 }}</a>
                                </div>
                            </div>
                            @endif
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Website</div>
                                <div class="col-lg-10">
                                    @if($lead->website)
                                        <a href="{{ $lead->website }}" target="_blank">{{ $lead->website }}</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Country</div>
                                <div class="col-lg-10">{{ $lead->country ?: 'N/A' }}</div>
                            </div>
                            @if($lead->disposition)
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Disposition</div>
                                <div class="col-lg-10">{{ $lead->disposition }}</div>
                            </div>
                            @endif
                            @if($lead->additional_details)
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Additional Details</div>
                                <div class="col-lg-10">{{ $lead->additional_details }}</div>
                            </div>
                            @endif
                            @if($lead->comments)
                            <div class="row mb-0">
                                <div class="col-lg-2 fw-medium">Comments</div>
                                <div class="col-lg-10">{{ $lead->comments }}</div>
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div class="card card-body general-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0">
                                    <span class="d-block mb-2">General Information :</span>
                                    <span class="fs-12 fw-normal text-muted d-block">General information for your lead</span>
                                </h5>
                                <!-- <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Edit Lead</a> -->
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Status</div>
                                <div class="col-lg-10 hstack gap-1">
                                    @if($lead->status)
                                        <span class="badge 
                                            @if($lead->status == 'New') bg-primary
                                            @elseif($lead->status == 'Contacted') bg-info
                                            @elseif($lead->status == 'Working') bg-warning
                                            @elseif($lead->status == 'Qualified') bg-success
                                            @elseif($lead->status == 'Declined') bg-danger
                                            @elseif($lead->status == 'Customer') bg-dark
                                            @else bg-secondary
                                            @endif">
                                            {{ $lead->status }}
                                        </span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Source</div>
                                <div class="col-lg-10 hstack gap-1">
                                    @if($lead->source)
                                        <div class="hstack gap-2">
                                            <div class="avatar-text avatar-sm">
                                                @if(strtolower($lead->source) == 'facebook')
                                                    <i class="feather-facebook"></i>
                                                @elseif(strtolower($lead->source) == 'twitter')
                                                    <i class="feather-twitter"></i>
                                                @elseif(strtolower($lead->source) == 'linkedin')
                                                    <i class="feather-linkedin"></i>
                                                @else
                                                    <i class="feather-globe"></i>
                                                @endif
                                            </div>
                                            <span>{{ $lead->source }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Created</div>
                                <div class="col-lg-10 hstack gap-1">
                                    <div class="hstack gap-2">
                                        <div class="avatar-text avatar-sm">
                                            <i class="feather-clock"></i>
                                        </div>
                                        <span>{{ $lead->created_at->format('d M, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Created By</div>
                                <div class="col-lg-10 hstack gap-1">
                                    @if($lead->user)
                                        <div class="hstack gap-2">
                                            <div class="avatar-text avatar-sm">
                                                <i class="feather-user"></i>
                                            </div>
                                            <span>{{ $lead->user->name ?? 'Admin' }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </div>
                            </div>
                            @if($lead->created_at != $lead->updated_at)
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Last Updated</div>
                                <div class="col-lg-10 hstack gap-1">
                                    <div class="hstack gap-2">
                                        <div class="avatar-text avatar-sm">
                                            <i class="feather-edit"></i>
                                        </div>
                                        <span>{{ $lead->updated_at->format('d M, Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            
        @endsection

@section('script')
@endsection 