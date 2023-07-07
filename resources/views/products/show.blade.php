@extends('layouts.app')
@section('main')
    <div class="wrapper">
        <img class="img-show-wrapper" src="/products/{{ $product->image }}" alt="product image" />
        <div class="px-5 pb-5">
            <p class="label-text-show-col">Name: <strong
                    class="font-semibold text-gray-900">{{ $product->name }}</strong> </p>


            <p class="label-text-show-col">Description: <strong
                    class="font-semibold text-gray-900">{{ $product->description }}</strong> </p>

        </div>
    </div>
@endsection
