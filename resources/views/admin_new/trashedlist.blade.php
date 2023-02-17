@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Students</h3>
                        <div class="alert alert-success alert-dismissible" role="alert" style="display: none;"></div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                            <li class="breadcrumb-item active">All Students</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if (Session::has('data'))
            <p class="alert alert-info">{{ Session::get('data') }}</p>
        @endif
        @if (Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Students</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('admin.student') }}" class="btn btn-outline-gray me-2 active"><i
                                            class="feather-arrow-left"></i></a>

                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="" class="btn btn-outline-gray me-2 active"><i
                                            class="feather-list"></i></a>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-student table-hover table-center mb-0  table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>#</th>
                                        <th style="width: 100px">Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Dob</th>
                                        <th>Blood Group</th>
                                        <th>Religion</th>
                                        <th>status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 1;
                                @endphp
                                <tbody id="showdata">
                                    @foreach ($trash as $student)
                                        <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td>{{ $i++ }}</td>
                                            <td><img class="avatar-img rounded-circle"
                                                    src="{{ asset('assets/img/' . $student->profile->picture) }}"
                                                    height="30" width="30">
                                                {{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->profile->phone }}</td>
                                            <td>{{ $student->profile->gender }}</td>
                                            <td>{{ $student->profile->dob }}</td>
                                            <td>{{ $student->profile->blood_group }}</td>
                                            <td>{{ $student->profile->religion }}</td>
                                            <td>
                                                <input type="checkbox" data-id="{{ $student->id }}" name="status"
                                                    class="js-switch" {{ $student->status == 1 ? 'checked' : '' }}>
                                            </td>

                                            <td class="text-end">
                                                <div class="actions ">
                                                    <a href="{{ route('admin.restore-data', ['id' => $student->uuid]) }}"
                                                        class="btn btn-sm bg-danger-light">
                                                        <i class="feather-repeat"></i>
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
        $("document").ready(function() {
            setTimeout(function() {
                $('.alert').hide(3000)
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
    {{-- <script>
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
    </script> --}}
@endsection
