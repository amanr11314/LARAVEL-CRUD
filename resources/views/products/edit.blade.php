@extends('layouts.app')
@section('main')
    <div class="wrapper">

        <p class="text-product-name-big">Product Edit #{{ $product->id }}</p>

        <form id="editForm" method="POST" action="/products/{{ $product->id }}/update" class="space-y-4"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <div>
                    <label for="name" class="label-input">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $product->name) }}"
                        class="input-name">
                </div>
                @if ($errors->has('name'))
                    <p class="mt-2 text-xs text-red-600">
                        {{ $errors->first('name') }} </p>
                @endif
            </div>

            <div>

                <div>
                    <label for="description" class="label-input">Description</label>
                    <textarea rows="4" id="description" class="input-desc" name="description">{{ old('description', $product->description) }}</textarea>
                </div>
                @if ($errors->has('description'))
                    <p class="mt-2 text-xs text-red-600">
                        {{ $errors->first('description') }} </p>
                @endif
            </div>

            <div>

                <div>
                    <label class="label-input" for="image">Image</label>
                    <input name="image" class="input-img" type="file">
                </div>
                @if ($errors->has('image'))
                    <p class="mt-2 text-xs text-red-600">
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
                    // return value.indexOf(" ") < 0 && value != "";
                }, "No space please and don't leave it empty");


                $("#editForm").validate({
                    rules: {
                        name: {
                            required: true,
                            noSpace: true
                        },
                        description: {
                            required: true,
                            noSpace: true
                        },
                    }
                });
            });
        </script>
    @endverbatim
@endsection
