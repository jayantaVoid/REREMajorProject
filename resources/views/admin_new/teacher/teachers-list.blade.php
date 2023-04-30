@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Teachers</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teachers</li>
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
                        <input type="text" class="form-control" placeholder="Search by Phone ...">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <span id="alert"></span>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Teachers</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="teachers.html" class="btn btn-outline-gray me-2 active"><i
                                            class="feather-list"></i></a>
                                    <a href="teachers-grid.html" class="btn btn-outline-gray me-2"><i
                                            class="feather-grid"></i></a>
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>
                                    <a href="{{ route('admin.teacher-add') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Teacher_Type</th>
                                        <th>Gender</th>
                                        <th>Status</th>
                                        <th>Qualification</th>
                                        <th>Religion</th>
                                        <th>Date of Joining</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="teacher-details.html" class="avatar avatar-sm me-2"><img
                                                            class="avatar-img rounded-circle"
                                                            src="{{ asset('assets/img/' . $teacher->profile->picture) }}"></a>
                                                    <a href="teacher-details.html">{{ $teacher->name }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $teacher->email }}</td>
                                            <td>{{ $teacher->profile->phone }}</td>
                                            <td>

                                                @if ($teacher->profile->isGeneral == 1)
                                                    <a href="{{ route('admin.general', ['id' => $teacher->uuid]) }}"
                                                        class="badge bg-success" style="cursor: pointer">GENERAL</a>
                                                @elseif ($teacher->profile->isHod == 1)
                                                    <a href="{{ route('admin.hod', ['id' => $teacher->uuid]) }}"
                                                        class="badge bg-warning" style="cursor: pointer">HOD</a>
                                                @endif
                                            </td>
                                            <td>{{ $teacher->profile->gender }}</td>
                                            <td> <input type="checkbox" data-id="{{ $teacher->id }}" name="status"
                                                    class="js-switch" {{ $teacher->status == 1 ? 'checked' : '' }}></td>
                                            <td>{{ $teacher->profile->qualification }}</td>
                                            <td>{{ $teacher->profile->religion }}</td>
                                            <td>{{ $teacher->profile->joining_date }}</td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{ route('admin.teacher-profile', ['id' => $teacher->uuid]) }}" class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.edit-teacher', ['id' => $teacher->uuid]) }}" class="btn btn-sm bg-danger-light">
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
    <script>
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            let switchery = new Switchery(html, {
                size: 'small'
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".js-switch").change(function() {
                // $('#alert').html('').show();
                var status = $(this).prop('checked') === true ? 1 : 0;
                var teacherid = $(this).data('id');
                // console.log(status,userid);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.status') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'status': status,
                        'teacher_id': teacherid
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data.status) {
                            setTimeout(function() {
                                alert(data.message);
                                // $('#alert').html(data.message).hide(3000);
                            });
                        }
                    }
                });
            });
        // });
        });
    </script>
@endsection
