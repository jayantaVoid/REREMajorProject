@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>
        @foreach ($teachersData as $teacher)
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <a href="#">
                                    <img class="rounded-circle" alt="User Image" src="{{ asset('assets/img/'. $teacher->profile->picture) }}">
                                </a>
                            </div>
                            <div class="col ms-md-n2 profile-user-info">
                                <h4 class="user-name mb-0">{{ $teacher->name }}</h4>
                                <h6 class="text-muted">Teacher</h6>
                                <div class="user-Location"><i class="fas fa-map-marker-alt"></i> {{ $teacher->profile->address }}
                                </div>
                                <div class="about-text">{{ $teacher->profile->state }}, {{ $teacher->profile->city }}-{{ $teacher->profile->zip_code }}
                                </div>
                            </div>
                            <div class="col-auto profile-btn">
                                <a href="" class="btn btn-primary">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="tab-content profile-tab-cont">

                        <div class="tab-pane fade show active" id="per_details_tab">

                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Personal Details</span>
                                                <a class="edit-link" data-bs-toggle="modal" href="#edit_personal_details"><i
                                                        class="far fa-edit me-1"></i>Edit</a>
                                            </h5>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name</p>
                                                <p class="col-sm-9">{{ $teacher->name }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Date of
                                                    Birth</p>
                                                <p class="col-sm-9">{{ $teacher->profile->dob }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Qualification</p>
                                                <p class="col-sm-9">{{ $teacher->profile->qualification }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email ID</p>
                                                <p class="col-sm-9"><a href="/cdn-cgi/l/email-protection"
                                                        class="__cf_email__"
                                                        data-cfemail="a1cbcec9cfc5cec4e1c4d9c0ccd1cdc48fc2cecc">{{ $teacher->email }}</a>
                                                </p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>
                                                <p class="col-sm-9">{{ $teacher->profile->phone }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>
                                                <p class="col-sm-9 mb-0">{{ $teacher->profile->address }}<br>
                                                    {{ $teacher->profile->state }},<br>
                                                    {{ $teacher->profile->city }} - {{ $teacher->profile->zip_code }},<br>
                                                    {{ $teacher->profile->country }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Teacher Type</span>
                                                <a class="edit-link" href="#"><i class="far fa-edit me-1"></i>
                                                    Edit</a>
                                            </h5>
                                            @if ($teacher->profile->isGeneral == 1)
                                                <button class="btn btn-warning" type="button"><i
                                                        class="fe fe-check-verified"></i>
                                                    General</button>
                                            @elseif ($teacher->profile->isHod == 1)
                                                <button class="btn btn-warning" type="button"><i
                                                        class="fe fe-check-verified"></i>
                                                    HOD</button>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Account Status</span>
                                                <a class="edit-link" href="#"><i class="far fa-edit me-1"></i>
                                                    Edit</a>
                                            </h5>
                                            @if ($teacher->status == 1)
                                                <button class="btn btn-success" type="button"><i
                                                        class="fe fe-check-verified"></i>
                                                    Active</button>
                                            @else
                                                <button class="btn btn-danger" type="button"><i
                                                        class="fe fe-check-verified"></i>
                                                    Inactive</button>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- <div id="password_tab" class="tab-pane fade">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Change Password</h5>
                                    <div class="row">
                                        <div class="col-md-10 col-lg-6">
                                            <form>
                                                <div class="form-group">
                                                    <label>Old Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
