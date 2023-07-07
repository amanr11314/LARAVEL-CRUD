@extends('layouts.app')
@section('main')
    <div class="wrapper">
        <form id="regForm" method="POST" action="/products/store" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <div>
                <div>
                    <label for="name" class="label-input">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" class="input-name">
                </div>
                @if ($errors->has('name'))
                    <p class="error-msg">
                        {{ $errors->first('name') }} </p>
                @endif
            </div>

            <div>

                <div>
                    <label for="description" class="label-input">Description</label>
                    <textarea rows="4"id="description" class="input-desc" name="description">{{ old('description') }}</textarea>
                </div>
                @if ($errors->has('description'))
                    <p class="error-msg">
                        {{ $errors->first('description') }} </p>
                @endif
            </div>

            <div>

                <div>
                    <label class="label-input" for="image">Image</label>
                    <input id="image" name="image" class="input-img" type="file">
                </div>
                @if ($errors->has('image'))
                    <p class="error-msg">
                        {{ $errors->first('image') }} </p>
                @endif


            </div>



            <button type="submit" class="btn-action-primary">Submit</button>
        </form>

    </div>

    @verbatim
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function() {

                jQuery.validator.addMethod("noSpace", function(value, element) {
                    return (value.trim().length > 0);
                }, "No space please and don't leave it empty");


                $("#regForm").validate({
                    errorClass: 'error-msg',
                    errorElement: 'p',
                    rules: {
                        name: {
                            required: true,
                            noSpace: true
                        },
                        description: {
                            required: true,
                            noSpace: true
                        },
                        image: "required"
                    },
                });

            });
        </script>
    @endverbatim
@endsection
