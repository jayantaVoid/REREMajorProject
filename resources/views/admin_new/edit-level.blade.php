@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Level</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.levels')}}">Levels</a></li>
                        <li class="breadcrumb-item active">Edit Level</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.update-level') }}">
                            @csrf
                            <input type="hidden" name="uuid" value="{{ $level->uuid }}">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Level Information</span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>From <span class="login-danger">*</span></label>
                                        <input type="number" name="from" step="any" value="{{$level->from}}"
                                            class="form-control @error('from') is-invalid @enderror">
                                        @error('from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>To <span class="login-danger">*</span></label>
                                        <input type="number" name="to" value="{{$level->to}}"
                                            class="form-control @error('to') is-invalid @enderror">
                                        @error('to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-8">
                                    <div class="form-group local-forms">
                                        <label>Level <span class="login-danger">*</span></label>
                                        <input type="text" name="level" value="{{$level->level}}"
                                            class="form-control @error('level') is-invalid @enderror">
                                        @error('level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
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

