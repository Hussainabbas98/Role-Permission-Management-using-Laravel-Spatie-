@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Edit Products') }}</div>

                    <div class="card-body">

                        <a href="{{route('products.index')}}" class="btn btn-info mb-3">Back</a>
 @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('products.update' , $products->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$products->name}}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Edit Products</button>
                        </form>
                        </div>
            </div>
        </div>
    </div>
@endsection