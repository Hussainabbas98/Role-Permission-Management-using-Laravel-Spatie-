@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Show Products') }}</div>

                    <div class="card-body">

                        <a href="{{route('products.index')}}" class="btn btn-info mb-3">Back</a>
                        <p><strong>Name:</strong>{{$products->name}}</p>
                        </div>
            </div>
        </div>
    </div>
@endsection