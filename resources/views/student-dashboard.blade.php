@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome {{ Auth::user()->name }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Student</li>
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
                                <h6>Exam Attended</h6>
                                <h3>{{$userData['totalAttendedExam']}}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/teacher-icon-01.svg') }}" alt="Dashboard Icon">
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
                                <h6>Total Exams</h6>
                                <h3>{{$userData['totalExam']}}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/teacher-icon-02.svg') }}" alt="Dashboard Icon">
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
                                <h6>Subject Available</h6>
                                <h3>{{$userData['totalSubject']}}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/teacher-icon-01.svg') }}" alt="Dashboard Icon">
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
                                <h6>Intelligence</h6>
                                <h3>{{$userData['intelligenceLevel']->level}}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/img/icons/teacher-icon-02.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-lg-12 col-xl-8">
                <div class="card flex-fill comman-shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Intellegence Level</h5>
                            </div>
                            <!-- <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-blue"></span><span class="circle-gray"></span><span
                                            class="circle-gray"></span></li>
                                    <li class="lesson-view-all"><a href="#">View All</a></li>
                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                    <div class="dash-circle">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 dash-widget1">
                                <div class="circle-bar circle-bar2">
                                    <div class="circle-graph2" data-percent="80">
                                        <canvas width="400" height="400"></canvas>
                                        <b>{{number_format($userData['intelligencePercentage'],2)}}%</b>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="dash-details">
                                    <div class="lesson-activity">
                                        <div class="lesson-imgs">
                                            <img src="assets/img/icons/lesson-icon-01.svg" alt="">
                                        </div>
                                        <div class="views-lesson">
                                            <h5>Class</h5>
                                            <h4>Electrical Engg</h4>
                                        </div>
                                    </div>
                                    <div class="lesson-activity">
                                        <div class="lesson-imgs">
                                            <img src="assets/img/icons/lesson-icon-02.svg" alt="">
                                        </div>
                                        <div class="views-lesson">
                                            <h5>Lessons</h5>
                                            <h4>5 Lessons</h4>
                                        </div>
                                    </div>
                                    <div class="lesson-activity">
                                        <div class="lesson-imgs">
                                            <img src="assets/img/icons/lesson-icon-03.svg" alt="">
                                        </div>
                                        <div class="views-lesson">
                                            <h5>Time</h5>
                                            <h4>Lessons</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="dash-details">
                                    <div class="lesson-activity">
                                        <div class="lesson-imgs">
                                            <img src="assets/img/icons/lesson-icon-04.svg" alt="">
                                        </div>
                                        <div class="views-lesson">
                                            <h5>Asignment</h5>
                                            <h4>5 Asignment</h4>
                                        </div>
                                    </div>
                                    <div class="lesson-activity">
                                        <div class="lesson-imgs">
                                            <img src="assets/img/icons/lesson-icon-05.svg" alt="">
                                        </div>
                                        <div class="views-lesson">
                                            <h5>Staff</h5>
                                            <h4>John Doe</h4>
                                        </div>
                                    </div>
                                    <div class="lesson-activity">
                                        <div class="lesson-imgs">
                                            <img src="assets/img/icons/lesson-icon-06.svg" alt="">
                                        </div>
                                        <div class="views-lesson">
                                            <h5>Lesson Learned</h5>
                                            <h4>10/50</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 d-flex align-items-center justify-content-center">
                                <div class="skip-group">
                                    <a href="{{route('admin.profile', ['id' => auth()->user()->uuid])}}">
                                        <button type="submit" class="btn btn-info skip-btn">Profile</button>
                                    </a>
                                    <a href="{{route('admin.student.exam-list')}}">
                                        <button type="submit" class="btn btn-info continue-btn">Continue</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-12 col-xl-4 d-flex">
                <div class="card flex-fill comman-shadow">
                    <div class="card-body">
                        <div id="calendar-doctor" class="calendar-container"></div>
                        <div class="calendar-info calendar-info1">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
