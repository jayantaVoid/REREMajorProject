@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header pt-2 ml-3">
                        <h3 class="page-title">Welcome Admin!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Admin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Students</h6>
                                <h3>{{ $studentUser }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/dash-icon-01.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Exams</h6>
                                <h3>{{$examCount}}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/dash-icon-02.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Subjects</h6>
                                <h3>{{$subjectCount}}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/dash-icon-02.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Exam Attempted </h6>
                                <h3>{{$examAttemptCount}}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/dash-icon-01.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 d-flex">

                <div class="card flex-fill student-space comman-shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title">Star Performances</h5>
                        <!-- <ul class="chart-list-out student-ellips">
                            <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table star-student table-hover table-center table-borderless table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th class="text-center">Exam</th>
                                        <th class="text-center">Percentage</th>
                                        <th class="text-end">Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($marks as $mark)
                                        <tr>
                                            <td class="text-nowrap">
                                                <div>{{$mark->user->email}}</div>
                                            </td>
                                            <td class="text-nowrap">
                                                <!-- <a href="profile.html">
                                                    <img class="rounded-circle" src="assets/img/profiles/avatar-02.jpg"
                                                        width="25" alt="Star Students">
                                                    John Smith
                                                </a> -->
                                                {{$mark->user->name}}
                                            </td>
                                            <td class="text-center">{{$mark->exam->name}}</td>
                                            <td class="text-center">{{number_format($mark->marks,2)}}%</td>
                                            <td class="text-end">
                                                <div>{{$mark->exam->level->level}}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
