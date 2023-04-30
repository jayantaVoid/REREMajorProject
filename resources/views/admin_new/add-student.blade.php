@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Add Students</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                            <li class="breadcrumb-item active">Add Students</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.storestudent') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title student-info">Student Information <span><a href="javascript:;"><i
                                                    class="feather-more-vertical"></i></a></span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Full Name <span class="login-danger">*</span></label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                            placeholder="Enter Full Name" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Department<span class="login-danger">*</span></label>
                                        <select class="form-control select @error('department_id') is-invalid @enderror"
                                            name="department_id">
                                            <option value="">Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Semester<span class="login-danger">*</span></label>
                                        <select class="form-control select @error('semester_id') is-invalid  @enderror"
                                            name="semester_id">
                                            <option value="">Select Semester</option>
                                            @foreach ($semesters as $semester)
                                                <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('semester_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Address <span class="login-danger">*</span></label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" rows="2" placeholder="Enter address"
                                            name="address">{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Gender <span class="login-danger">*</span></label>
                                        <select class="form-control select @error('gender') is-invalid @enderror"
                                            name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                            </option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Others" {{ old('gender') == 'Others' ? 'selected' : '' }}>Others
                                            </option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Password <span class="login-danger">*</span></label>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                                            placeholder="Enter Your password" name="password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date Of Birth <span class="login-danger">*</span></label>
                                        <input class="form-control @error('dob') is-invalid @enderror" type="date"
                                            name="dob" value="{{ old('dob') }}">
                                        @error('dob')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Blood Group <span class="login-danger">*</span></label>
                                        <select class="form-control select @error('blood_group') is-invalid @enderror"
                                            name="blood_group">
                                            <option value="">Please Select Group </option>
                                            <option value="B+"{{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+
                                            </option>
                                            <option value="A+"{{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+
                                            </option>
                                            <option value="O+"{{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+
                                            </option>
                                            <option value="A-"{{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-
                                            </option>
                                            <option value="O-"{{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-
                                            </option>
                                            <option value="B-"{{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-
                                            </option>
                                            <option value="AB+"{{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+
                                            </option>
                                            <option value="AB-"{{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-
                                            </option>
                                        </select>
                                        @error('blood_group')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Religion <span class="login-danger">*</span></label>
                                        <select class="form-control @error('religion') is-invalid @enderror"
                                            name="religion">
                                            <option value="">Please Select Religion </option>
                                            <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>
                                                Hindu
                                            </option>
                                            <option value="Christian"
                                                {{ old('religion') == 'Christian' ? 'selected' : '' }}>Christian</option>
                                            <option value="Others" {{ old('religion') == 'Others' ? 'selected' : '' }}>
                                                Others</option>
                                        </select>
                                        @error('religion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>E-Mail <span class="login-danger">*</span></label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="text"
                                            placeholder="Enter Email Address" name="email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Phone </label>
                                        <input class="form-control @error('phone') is-invalid @enderror" type="text"
                                            placeholder="Enter Phone Number" name="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group students-up-files">
                                        <label>Upload Student Photo (150px X 150px)</label>
                                        <div class="uplod">
                                            <label class="file-upload image-upbtn mb-0">
                                                Choose File <input type="file" name="image"
                                                    class="form-control @error('image') is-invalid @enderror">
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
