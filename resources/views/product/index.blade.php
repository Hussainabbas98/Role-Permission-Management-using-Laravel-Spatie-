@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-body">
                        @session("success")
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endsession
                        @can('product-create')
                        <a href="{{route('products.create')}}" class="btn btn-success mb-3">Create Product</a>
                        @endcan
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        {{-- <td>{{ $product->created_at }}</td> --}}
                                        <td>
                                            @can('product-list')
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                                            @endcan
                                            @can('product-edit')
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            @endcan
                                            @can('product-delete')
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection