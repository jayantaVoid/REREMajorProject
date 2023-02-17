@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Students</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                            <li class="breadcrumb-item active">All Students</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body pb-0">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Students</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('admin.student') }}" class="btn btn-outline-gray me-2"><i
                                            class="feather-list"></i></a>
                                    <a href="students-grid.html" class="btn btn-outline-gray me-2 active"><i
                                            class="feather-grid "></i></a>
                                </div>
                            </div>
                        </div>
                            <div class="student-pro-list">
                                <div class="row">
                                    @foreach ($students as $student)
                                    <div class="col-xl-3 col-lg-3 col-md-6 d-flex">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="student-box flex-fill">

                                                    <div class="student-img">
                                                        <a href="student-details.html">
                                                            <img class="img-fluid" alt="Students Info"
                                                                src="{{ asset('assets/img/'.$student->profile->picture) }}">
                                                        </a>
                                                    </div>
                                                    <div class="student-content pb-0">
                                                        <h5><a href="student-details.html">{{ $student->name }}</a></h5>
                                                        @if ($student->status == 0)
                                                            <span class="badge bg-warning text-dark">Inactive</span>
                                                        @else
                                                        <span class="badge bg-info text-dark">Active</span>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
