@extends('layouts.app')

@section('title', 'User Lists')
@section('content')
    <div class="container mt-4">
        @if(session('success'))
        <div  class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('danger'))
        <div  class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="mb-2 d-flex">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mb-3">Create</a>
        </div>
        <div class="card">
            <div class="card-header d-flex">
                <h3>User Lists</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role}}</td>
                                <td class="d-flex">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm">
                                        Edit
                                    </a>
                                    <a href="{{ route('users.show', $user->id) }}"
                                        class="btn btn-secondary btn-sm mx-2">View</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
