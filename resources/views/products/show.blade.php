@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 mt-4">
                <div class="card p-4">
                    <span><b>{{ $product->name }}</b></span> <br>
                    <img src="/products/{{ $product->image }}" class="rounded mx-auto d-block" alt="Responsive image"
                        height="450" width="550"><br>
                    <span><b>{{ $product->description }}</b></span>
                </div>
            </div>
        </div>
    </div>
@endsection
