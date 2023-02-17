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

        <div class="row">
            <div class="col-md-12">
                <div class="profile-header">
                    <div class="row align-items-center">
                        <div class="col-auto profile-image">
                            <a href="#">
                                <img class="rounded-circle" alt="User Image"
                                    src="{{ asset('assets/img/' .auth()->user()->profile()->first()->picture) }}">
                            </a>
                        </div>
                        <div class="col ms-md-n2 profile-user-info">
                            <h4 class="user-name mb-0">{{ auth()->user()->name }}</h4>
                            <h6 class="text-muted">{{ auth()->user()->roles()->first()->role_name }}</h6>
                            <div class="user-Location"><i class="fas fa-map-marker-alt"></i>
                                {{ auth()->user()->profile->address }}</div>
                        </div>
                    </div>
                </div>
                <div class="profile-menu">
                    <ul class="nav nav-tabs nav-tabs-solid " id="profile_tab">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                        </li>
                    </ul>

                </div>
                @if (Session::has('error'))
                        <p class="alert alert-danger mt-2">{{ Session::get('error') }}</p>
                    @endif
                    @if (Session::has('status'))
                        <p class="alert alert-info mt-2">{{ Session::get('status') }}</p>
                    @endif
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
                                            <p class="col-sm-9">{{ auth()->user()->name }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Date of
                                                Birth</p>
                                            <p class="col-sm-9">{{ auth()->user()->profile->dob }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email ID</p>
                                            <p class="col-sm-9">{{ auth()->user()->email }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>
                                            <p class="col-sm-9">{{ auth()->user()->profile->phone }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>
                                            <p class="col-sm-9 mb-0">{{ auth()->user()->profile->address }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title d-flex justify-content-between">
                                            <span>Account Status</span>
                                            <a class="edit-link" href="#"><i class="far fa-edit me-1"></i>
                                                Edit</a>
                                        </h5>
                                        @if (auth()->user()->status == 1)
                                            <button class="btn btn-warning" type="button"><i
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


                    <div id="password_tab" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Change Password</h5>
                                <div class="row">
                                    <div class="col-md-10 col-lg-6">
                                        <form method="post" id="submitform" action="{{ route('admin.update-password') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input type="password"
                                                    class="form-control @error('old_password') is-invalid @enderror"
                                                    name="old_password">
                                                @error('old_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    name="new_password">
                                                @error('new_password')
                                                    <span class="invalid-feedback" role="alert" id="new_pass">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control"
                                                    name="new_password_confirmation">
                                            </div>
                                            <button class="btn btn-primary" type="submit">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#profile_tab a[href="' + activeTab + '"]').tab('show');
            }
            setTimeout(function() {
                $('.alert').hide(3000)
            });
        });
    </script>
@endsection
