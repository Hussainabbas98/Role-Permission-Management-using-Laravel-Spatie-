@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Create Roles') }}</div>

                    <div class="card-body">

                        <a href="{{route('roles.index')}}" class="btn btn-info mb-3">Back</a>
 @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="permissions" class="form-label">Permissions</label>
                                <br>
                                @foreach($permissions as $permission)
                                    <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}">{{ $permission->name }}</input>
                                    <br>
                                    @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Create Role</button>
                        </form>
                        </div>
            </div>
        </div>
    </div>
@endsection