@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Departments</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Departments</li>
                    </ul>
                </div>
            </div>
        </div>
        @if (Session::has('status'))
            <p class="alert alert-info">{{ Session::get('status') }}</p>
        @endif
        @if (Session::has('data'))
            <div class="alert alert-info">{{ Session::get('data') }}</div>
        @endif
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
                        <input type="text" class="form-control" placeholder="Search by Year ...">
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
                                    <h3 class="page-title">Departments</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>
                                    <a href="{{ route('admin.department-add') }}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>

                                    <th>#</th>
                                    <th>Dept No</th>
                                    <th>Name</th>
                                    <th>HOD</th>
                                    <th>No of Students</th>
                                    <th class="text-end">Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $department->dept_no }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $findHods[$i - 2]->name ?? '-' }}</td>
                                        <td>{{ $user_info[$i - 2]->total ?? '0' }}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="javascript:;" class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-eye"></i>
                                                </a>
                                                <a href="edit-department.html" class="btn btn-sm bg-danger-light">
                                                    <i class="feather-edit"></i>
                                                </a>

                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary add-semester"
                                                value="{{ $department->id }}">
                                                <i class="feather-plus-circle"></i>
                                            </button>
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
    <!-- Modal -->
    <div class="modal fade" id="attach-student">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Semesters List</h1>
                    <button type="button" class="btn-close close1" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table comman-shadow">
                                <div class="card-body">
                                    <input type="hidden" class="form-control" id="dept_id">
                                    <div class="table-responsive">
                                        <table
                                            class="table border-0 star-student table-hover table-center mb-0  table-striped">
                                            <thead class="student-thread">
                                                <tr>
                                                    <th>
                                                        <div class="form-check check-tables">
                                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                                        </div>
                                                    </th>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                </tr>
                                            </thead>
                                            @php
                                                $i = 1;
                                            @endphp
                                            <tbody id="showdata">
                                                @if (count($semesters) > 0)
                                                    @foreach ($semesters as $semester)
                                                        <tr>
                                                            <td>
                                                                <div class="form-check check-tables">
                                                                    <input class="form-check-input stud-cb" type="checkbox"
                                                                        name="ids[]" value="{{ $semester->id }}">
                                                                </div>
                                                            </td>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $semester->name }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="7">semester Not Found</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close1" id="close">Close</button>
                    <button type="button" id="add" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal end --}}
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.add-semester', function() {
                var dept_id = $(this).val();
                $('#dept_id').val(dept_id);
                $("#attach-student").modal('show');


            });
            $(document).on('click', '.close1', function() {
                $('.stud-cb').prop('checked', false);
                $('#attach-student').modal('hide');
            });


            $("#add").click(function(e) {
                var semester = [];
                var dept_id = $('#dept_id').val();
                $.each($("input[name = 'ids[]']:checked"), function() {
                    semester.push($(this).val());
                });

                // console.log(dept_id, semester);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.attach') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'semesters': semester,
                        'dept_id': dept_id
                    },
                    success: function(response) {
                        if(response.status)
                        {
                            setTimeout(function(){
                                ('.alert').html(response.message).hide(3000);
                            });
                        }
                    }
                });
            });

            $('#checkAll').click(function() {
                $('input:checkbox').prop('checked', this.checked);
            });
        });
    </script>
@endsection
