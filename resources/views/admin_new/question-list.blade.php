@extends('admin_new.layouts.app')
@section('content')
<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Questions</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.exam-list')}}">Exam</a></li>
                    <li class="breadcrumb-item active">Question</li>
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
                                <h3 class="page-title">Questions</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                
                                <a href="{{ route('admin.add-question') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table
                            class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th>Question</th>
                                    <th>Options</th>
                                    <th>Answer</th>
                                    <!-- <th class="text-end">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($questions as $question)
                                    <tr>
                                        <td>
                                            <h2>
                                                <a>{{$question->name}}</a>
                                            </h2>
                                        </td>
                                        @if($question->options != null)
                                            <td>
                                                @foreach($question->options as $option)
                                                    {{$option->option }}
                                                @endforeach
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{$question->answer->option ?? ""}}</td>
                                        <!-- <td class="text-end">
                                            <div class="actions">
                                                
                                                <a href="#" class="btn btn-sm bg-danger-light">
                                                    <i class="feather-edit"></i>
                                                </a>
                                            </div>
                                        </td> -->
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

