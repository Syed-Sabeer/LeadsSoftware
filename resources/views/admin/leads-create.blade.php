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
                        <li class="breadcrumb-item">{{ isset($lead) ? 'Edit' : 'Create' }}</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            <!-- <a href="javascript:void(0);" class="btn btn-light-brand successAlertMessage">
                                <i class="feather-layers me-2"></i>
                                <span>Save as Draft</span>
                            </a> -->
                            <button type="submit" class="btn btn-primary" form="leadForm">
                                <i class="feather-user-plus me-2"></i>
                                <span>{{ isset($lead) ? 'Update Lead' : 'Create Lead' }}</span>
                            </button>
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
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="leadForm" action="{{ isset($lead) ? route('admin.leads.update', $lead->id) : route('admin.leads.store') }}" method="POST">
                            @csrf
                            @if(isset($lead))
                                @method('PUT')
                            @endif
                        <div class="card stretch stretch-full">
                            <div class="card-body lead-status">
                                <div class="mb-5 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0 me-4">
                                        <span class="d-block mb-2">Lead Status :</span>
                                        <span class="fs-12 fw-normal text-muted text-truncate-1-line">Typically refers to adding a new potential customer or sales prospect</span>
                                    </h5>
                                    <!-- <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Create Invoice</a> -->
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 mb-4">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control" data-select2-selector="status">
                                            <option value="New" data-bg="bg-primary" {{ (isset($lead) && $lead->status == 'New') ? 'selected' : '' }}>New</option>
                                            <option value="Contacted" data-bg="bg-teal" {{ (isset($lead) && $lead->status == 'Contacted') ? 'selected' : '' }}>Contacted</option>
                                            <option value="Working" data-bg="bg-warning" {{ (isset($lead) && $lead->status == 'Working') ? 'selected' : '' }}>Working</option>
                                            <option value="Qualified" data-bg="bg-success" {{ (isset($lead) && $lead->status == 'Qualified') ? 'selected' : '' }}>Qualified</option>
                                            <option value="Declined" data-bg="bg-danger" {{ (isset($lead) && $lead->status == 'Declined') ? 'selected' : '' }}>Declined</option>
                                            <option value="Customer" data-bg="bg-indigo" {{ (isset($lead) && $lead->status == 'Customer') ? 'selected' : '' }}>Customer</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <label class="form-label">Source</label>
                                        <select name="source" class="form-control" data-select2-selector="icon">
                                            <option value="Facebook" data-icon="feather-facebook" {{ (isset($lead) && $lead->source == 'Facebook') ? 'selected' : '' }}>Facebook</option>
                                            <option value="Twitter" data-icon="feather-twitter" {{ (isset($lead) && $lead->source == 'Twitter') ? 'selected' : '' }}>Twitter</option>
                                            <option value="Instagram" data-icon="feather-instagram" {{ (isset($lead) && $lead->source == 'Instagram') ? 'selected' : '' }}>Instagram</option>
                                            <option value="LinkedIn" data-icon="feather-linkedin" {{ (isset($lead) && $lead->source == 'LinkedIn') ? 'selected' : '' }}>Linkedin</option>
                                            <option value="Search Engine" data-icon="feather-search" {{ (isset($lead) && $lead->source == 'Search Engine') ? 'selected' : '' }}>Search Engine</option>
                                            <option value="Others" data-icon="feather-compass" {{ (isset($lead) && $lead->source == 'Others') ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                    
                              
                                </div>
                            </div>
                            <hr class="mt-0">
                            <div class="card-body general-info">
                                <div class="mb-5 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0 me-4">
                                        <span class="d-block mb-2">Lead Info :</span>
                                        <span class="fs-12 fw-normal text-muted text-truncate-1-line">General information for your lead</span>
                                    </h5>
                                    <!-- <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Edit Lead</a> -->
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Full Name: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-user"></i></div>
                                            <input type="text" name="fullname" class="form-control" id="fullnameInput" placeholder="Full Name" value="{{ isset($lead) ? $lead->fullname : old('fullname') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="mailInput" class="fw-semibold">Email: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-mail"></i></div>
                                            <input type="email" name="email" class="form-control" id="mailInput" placeholder="Email" value="{{ isset($lead) ? $lead->email : old('email') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="phoneInput" class="fw-semibold">Phone 1: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-phone"></i></div>
                                            <input type="text" name="phone1" class="form-control" id="phoneInput" placeholder="Phone 1" value="{{ isset($lead) ? $lead->phone1 : old('phone1') }}">
                                        </div>
                                    </div>
                                </div>

                                 <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="phoneInput" class="fw-semibold">Phone 2: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-phone"></i></div>
                                            <input type="text" name="phone2" class="form-control" id="phone2Input" placeholder="Phone 2" value="{{ isset($lead) ? $lead->phone2 : old('phone2') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="companyInput" class="fw-semibold">Company: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-compass"></i></div>
                                            <input type="text" name="company" class="form-control" id="companyInput" placeholder="Company" value="{{ isset($lead) ? $lead->company : old('company') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="websiteInput" class="fw-semibold">Website: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-link"></i></div>
                                            <input type="url" name="website" class="form-control" id="websiteInput" placeholder="Website" value="{{ isset($lead) ? $lead->website : old('website') }}">
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="addressInput" class="fw-semibold">Disposition: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-map-pin"></i></div>
                                            <textarea name="disposition" class="form-control" id="dispositionInput" cols="30" rows="3" placeholder="Disposition">{{ isset($lead) ? $lead->disposition : old('disposition') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="addressInput" class="fw-semibold">Additional Details: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-map-pin"></i></div>
                                            <textarea name="additional_details" class="form-control" id="additionalDetailsInput" cols="30" rows="3" placeholder="Additional Details">{{ isset($lead) ? $lead->additional_details : old('additional_details') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="descriptionInput" class="fw-semibold">Comments: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <textarea name="comments" class="form-control" id="commentsInput" cols="30" rows="5" placeholder="Comments">{{ isset($lead) ? $lead->comments : old('comments') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label class="fw-semibold">Country: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select name="country" class="form-control" data-select2-selector="country">
                                            <option value="">Select Country</option>
                                            <option value="United States" {{ (isset($lead) && $lead->country == 'United States') ? 'selected' : '' }}>United States</option>
                                            <option value="United Kingdom" {{ (isset($lead) && $lead->country == 'United Kingdom') ? 'selected' : '' }}>United Kingdom</option>
                                            <option value="Canada" {{ (isset($lead) && $lead->country == 'Canada') ? 'selected' : '' }}>Canada</option>
                                            <option value="Australia" {{ (isset($lead) && $lead->country == 'Australia') ? 'selected' : '' }}>Australia</option>
                                            <option value="India" {{ (isset($lead) && $lead->country == 'India') ? 'selected' : '' }}>India</option>
                                            <option value="Zimbabwe" {{ (isset($lead) && $lead->country == 'Zimbabwe') ? 'selected' : '' }}>Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                             
                              
                          
                         
                         
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            
            
        @endsection

@section('script')
@endsection 