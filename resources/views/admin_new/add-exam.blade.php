@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Exam</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.exam-list')}}">Exam</a></li>
                        <li class="breadcrumb-item active">Add Exam</li>
                    </ul>
                </div>
            </div>
        </div>
        @if (Session::has('status'))
            <p class="alert alert-info">{{ Session::get('status') }}</p>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.store-exam') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Exam Information</span></h5>
                                </div>
                                <div class="row2">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Select Subject Tag</label>
                                            <select class="form-control select @error('subject_tag') is-invalid @enderror" name="subject_tag">
                                                <option value="">Choose Subject Tag</option>
                                                @foreach($subjectTags as $subjectTag)
                                                    <option value="{{$subjectTag->id}}">{{$subjectTag->name}}</option> 
                                                @endforeach
                                            </select>
                                            @error('subject_tag')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Select Level Tag</label>
                                            <select class="form-control select @error('level_tag') is-invalid @enderror" name="level_tag">
                                                <option value="">Choose Level Tag</option>
                                                @foreach($levelTags as $levelTag)
                                                    <option value="{{$levelTag->id}}">{{$levelTag->level}}</option> 
                                                @endforeach
                                            </select>
                                            @error('level_tag')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row1">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter exam name" name="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row2">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Exam Duration</label>
                                        @error('exam_time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- EXam Duration -->
                            <div class="col-12 col-sm-2">
                                <!-- Hours -->
                                <div class="form-group">
                                    <label>Hours</label>
                                    <select class="form-control select @error('hour') is-invalid @enderror" name="hour">
                                        @for($i=0;$i<=24;$i++)
                                            <option value="{{$i}}">{{$i}}</option> 
                                        @endfor
                                    </select>
                                    @error('hour')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Minutes -->
                                            
                                <div class="form-group">
                                    <label>Minutes</label>
                                    <select class="form-control select @error('minute') is-invalid @enderror" name="minute">
                                        
                                        @for($i=0;$i<=60;$i++)
                                            <option value="{{$i}}">{{$i}}</option> 
                                        @endfor
                                    </select>
                                    @error('minute')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Seconds -->
                                            
                                <div class="form-group">
                                    <label>Seconds</label>
                                    <select class="form-control select @error('second') is-invalid @enderror" name="second">
                                    @for($i=0;$i<=60;$i++)
                                            <option value="{{$i}}">{{$i}}</option> 
                                    @endfor
                                        
                                    </select>
                                    @error('second')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Seconds -->
                                            
                            </div>


                                            
                                            

                                            
                                            

                                        
                            
                            
                            <div class="col-12">
                                <input type="submit" class="btn btn-primary"></input>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
