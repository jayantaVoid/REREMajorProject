@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Question</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="exam.html">Exam</a></li>
                        <li class="breadcrumb-item active">Add Question</li>
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
                        <form method="post" action="{{ route('admin.store-question') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Question Information</span></h5>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Question</label>
                                        <input type="text" class="form-control @error('question') is-invalid @enderror"
                                            placeholder="Enter question" name="question">
                                        @error('question')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row1">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Option 1</label>
                                        <input type="text"
                                            class="form-control input-field @error('inputs.*.option') is-invalid @enderror"
                                            placeholder="Enter option 1" name="inputs[0]">
                                        @error('inputs.*.option')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <button class="add_form_field" id="add-button"><i class="fas fa-plus-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row1">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Option 2</label>
                                        <input type="text"
                                            class="form-control input-field @error('inputs.*.name') is-invalid @enderror"
                                            placeholder="Enter option 2" name="inputs[0]">
                                        @error('inputs.*.name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row1">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Option 3</label>
                                        <input type="text"
                                            class="form-control input-field @error('inputs.*.name') is-invalid @enderror"
                                            placeholder="Enter option 3" name="inputs[0]">
                                        @error('inputs.*.name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="row1">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Option 4</label>
                                        <input type="text"
                                            class="form-control input-field @error('inputs.*.name') is-invalid @enderror"
                                            placeholder="Enter option 4" name="inputs[0]">
                                        @error('inputs.*.name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                            </div> --}}
                            <div class="row2">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label>Answer</label>
                                        <select id="option-select" class="form-control select @error('answer') is-invalid @enderror" name="answer">
                                            <option value="">Choose Correct Option</option>
                                        </select>
                                        @error('answer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
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
@push('script')
    <script>
        $(document).ready(function() {
            var max_fields = 4;
            var wrapper = $(".row1");
            var x = 1;
            $('#add-button').on('click', function(e) {
                e.preventDefault();
                if (x < max_fields) {
                    x++;
                    $(wrapper).append(
                                `<div class="col-12 col-sm-4">
                                    <div class="form-group input-row">
                                        <label>Option ${x}</label>
                                        <input type="text"
                                            class="form-control input-field"
                                            placeholder="Enter option ${x}" name="inputs[`+x+`]">
                                            <button class="btn btn-danger remove-button">Remove</button>
                                    </div>
                                </div>`
                    ); //add input box
                } else {
                    alert('You maximum add 4 options')
                }
            });

            $(document).on('keyup', '.input-field', function() {
                const $selectedOptions = $('.input-field').map(function() {
                    return $(this).val();
                }).get();

                const $selectBox = $('#option-select');
                $selectBox.empty();

                $selectedOptions.forEach(function(option,index) {
                    // const $optionElement = $('<option>', {
                    //     value: option,
                    //     text: option
                    // });
                    $selectBox.append(`<option value="${index}">${option}</option>`);
                });
            });

            $(document).on('click', '.remove-button', function() {
                $(this).parent('.input-row').remove();
                $('.input-field').trigger('keyup');
            });
        });
    </script>
@endpush