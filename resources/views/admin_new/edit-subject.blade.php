@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Tag Subject</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="subjects.html">Subject</a></li>
                        <li class="breadcrumb-item active">Edit Tag Subject</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.update-subject') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="uuid" value="{{ $subject->uuid }}">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Subject Tag Information</span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Subject Name <span class="login-danger">*</span></label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" value="{{$subject->name}}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label></label>
                                        <label class="file-upload image-upbtn mb-0">
                                            Suject Tag Image <span class="login-danger">*</span>
                                            <input type="file" name="subject_image"
                                                        class="form-control @error('subject_image') is-invalid @enderror">
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </label>
                                    </div>
                                </div>
                                <!-- <div class="col-12 col-sm-4"> -->
                                    <!-- Image Preview -->
                                    <!-- <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                    alt="preview image" style="max-height: 250px;">
                                </div> -->
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Update</button>
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

