@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Users</h3>
                        <div class="alert alert-success alert-dismissible" role="alert" style="display: none;"></div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(null)">User</a></li>
                            <li class="breadcrumb-item active">All Users</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if (Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif
        @if (Session::has('data'))
            <p class="alert alert-info">{{ Session::get('data') }}</p>
        @endif
        @if (Session::has('status'))
            <p class="alert alert-info">{{ Session::get('status') }}</p>
        @endif
        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-10 col-md-6">
                    <div class="form-group">
                        <!-- <input type="text" class="form-control" id="search" placeholder="Search users here"> -->
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="search-student-btn">
                        <!-- <button type="btn" class="btn btn-primary" id="searchbtn">Search</button> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Users</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <!-- <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                            class="feather-list"></i></a>
                                    <a href="{{ route('admin.showgrid') }}" class="btn btn-outline-gray me-2"><i
                                            class="feather-grid"></i></a>
                                    <a href="{{ route('admin.trash-data') }}" class="btn btn-outline-primary me-2"><i
                                            class="fas fa-trash"></i></a> -->
                                    <a href="{{ route('admin.addstudent') }}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-student table-hover table-center mb-0  table-striped">
                                <thead class="student-thread">
                                    <tr>

                                        <th>#</th>
                                        <th style="width: 100px">Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Block/Unblock</th>
                                        <!-- <th class="text-end">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody id="showdata">
                                    @if (count($students) > 0)
                                        @foreach ($students as $key => $student)
                                            <tr>

                                                <td>{{ $key + 1 }}</td>
                                                
                                                <td>    {{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                {{-- <td>{{ $student->department->name }}</td> --}}
                                                <td>
                                                    <input type="checkbox" data-id="{{ $student->id }}" name="status"
                                                        class="js-switch" {{ $student->status == 1 ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    @if ($student->is_block == 0)
                                                        <a href="{{ route('admin.block-student', ['id' => $student->uuid]) }}"
                                                            class="badge bg-warning text-dark">Unblock
                                                        </a>
                                                    @else
                                                        <a href="{{ route('admin.block-student', ['id' => $student->uuid]) }}"
                                                            class="badge bg-danger text-white">Block
                                                        </a>
                                                    @endif
                                                </td>
                                                <!-- <td class="text-end">
                                                    <div class="actions ">
                                                        <a href="{{ route('admin.editstudent', ['id' => $student->uuid]) }}"
                                                            class="btn btn-sm bg-danger-light">
                                                            <i class="feather-edit"></i>
                                                        </a>

                                                        <a href="{{ route('admin.deletestudent', ['id' => $student->uuid]) }}"
                                                            class="btn btn-sm bg-danger-light">
                                                            <i class="feather-trash-2"></i>
                                                        </a>
                                                    </div>
                                                </td> -->
                                            </tr>
                                        @endforeach
                                    @else
                                        <div colspan="10">No Data Found</div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $('.alert').hide(3000)
            });
        });
        $("#search").keyup(function() {
            search_val = $("#search").val();
            var editurl = '{{ url('edit-data') }}';

            var html = '';
            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('admin.search') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'search': search_val,
                },
                success: function(data) {
                    // console.log(data);
                    $("#showdata").html('');
                    x = 1;
                    if (data.length) {
                        $.each(data, function(key, value) {
                            html += '<tr>' +
                                '<td>' + [key + 1] + '</td>' +
                                '<td>' + value.name + '</td>' +
                                '<td>' + value.email + '</td>' +
                                '<td>' + value.status + '</td>' +
                                
                                '<td> <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" id=""></div></td>' +
                                '<td><div class="actions "><a href="' + editurl + '/' + value
                                .uuid + '" class="btn btn-sm bg-danger-light">' +
                                '<i class="feather-edit"></i></a></div></td></tr>';
                        });
                    }
                    console.log(html);
                    $("#showdata").append(html);
                }
            });
        });
    </script>
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
            $('.js-switch').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let userId = $(this).data('id');
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "{{ route('admin.update-status') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'status': status,
                        'user_id': userId
                    },
                    success: function(data) {
                        if (data.status) {
                            setTimeout(function() {
                                $('.alert').html(data.message).hide(3000);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
