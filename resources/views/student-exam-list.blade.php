@extends('admin_new.layouts.app')
@section('content')
<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Exam</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Exam</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Exam</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">

                                <a href="{{ route('admin.add-exam') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table
                            class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th>Exam Name</th>
                                    <th>Subject Tag</th>
                                    <th>Exam Time</th>
                                    <th class="text-end"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($examLists as $examList)
                                    <tr>
                                        <td>
                                            <h2>
                                                <a>{{$examList->name}}</a>
                                            </h2>
                                        </td>
                                        <td>{{$examList->subject->name}}</td>
                                        <td>{{$examList->exam_time}}</td>
                                        <td class="text-end">
                                            @if(in_array($examList->id,$examGivenIds))
                                               <strong>Intelligence : </strong> {{number_format($examList->marks[0]->marks,2)}}%
                                            @else
                                                <!-- <div class="actions"> -->
                                                    <a href="{{route('admin.exam',['uuid' => $examList->uuid])}}" class="btn btn-primary bg-white">
                                                        Start Exam
                                                    </a>
                                                    <!-- <a href="{{route('admin.exam',['uuid' => $examList->uuid])}}" class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-eye"></i>
                                                    </a> -->
                                                    <!-- <a href="{{route('admin.edit-exam',['id' => $examList->uuid])}}" class="btn btn-sm bg-danger-light">
                                                        <i class="feather-edit"></i>
                                                    </a> -->
                                                <!-- </div> -->
                                            @endif
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
@endsection

