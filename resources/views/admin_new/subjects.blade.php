@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Subjects</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Subjects</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by ID ...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Name ...">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Class ...">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary">Search</button>
                    </div>
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
                                    <h3 class="page-title">Subjects</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>
                                    <a href="{{ route('admin.subject-add') }}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($listSubject as $subject)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                <h2>
                                                    <a>{{ $subject->name }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $subject->department[0]['name'] }}</td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="javascript:;" class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-eye"></i>
                                                    </a>
                                                    <a href="edit-subject.html" class="btn btn-sm bg-danger-light">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                </div>
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
