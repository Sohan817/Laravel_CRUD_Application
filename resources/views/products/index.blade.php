@extends('layouts.app')
@section('main')
    <div class="container text-right">
        <div class="float-end">
            <a href="{{ route('products.create') }}" class="btn btn-dark mt-2">New Products</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider mt-4">
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td><a href="products/{{ $product->id }}/show" class="text-dark">{{ $product->name }}</a></td>
                        <td><img src="products/{{ $product->image }}"class="rounded-circle" width="40" height="40">
                        </td>
                        <td><a href="products/{{ $product->id }}/edit" class="btn btn-dark btn-sm">Edit</a>
                            {{-- <a href="products/{{ $product->id }}/delete" class="btn btn-danger btn-sm">Delete</a> --}}
                            <form action="products/{{ $product->id }}/delete" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {{ $products->links() }}
    </div>
@endsection
