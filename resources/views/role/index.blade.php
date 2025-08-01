@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Roles') }}</div>

                    <div class="card-body">
                        @session("success")
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endsession
                        @can('role-create')
                        <a href="{{route('roles.create')}}" class="btn btn-success mb-3">Create Roles </a>
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
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        {{-- <td>{{ $role->created_at }}</td> --}}
                                        <td>
                                            @can('role-list')
                                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm">View</a>
                                            @endcan
                                            @can('role-edit')
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            @endcan
                                            @can('role-delete')
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
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