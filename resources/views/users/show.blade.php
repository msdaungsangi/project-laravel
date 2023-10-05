@extends('layouts')
@section('title', 'User Detail')
@section('content')
    <div class="container">
        <div class="card my-5">
            <h4 class="card-header font-weight-bold">
                User Detail
            </h4>
            <div class="card-body">
                <div>
                    <h4>Name: <small class="fs-5">{{ $user->name }}</small></h4>
                </div>
                <div class="my-4">
                    <h4>Email: <small class="fs-5">{{ $user->email }}</small></h4>
                </div>
                <div>
                    <h4>Role: <small class="fs-5">{{ $user->role }}</small></h4>
                </div>
                <div>
                    <h4>Created By: <small class="fs-5">{{ $user->created_by }}</small></h4>
                </div>
                <div>
                    <h4>Updated By: <small class="fs-5">{{ $user->updated_by }}</small></h4>
                </div>
                <div>
                    <h4>Image: </h4>
                    <img src="{{ asset('storage/images/'.$user->img) }}" alt="User Image" class="col-3">
                </div>
                <div class="mt-2">
                    <a href="{{ route('users.index') }}" type="submit" class="btn btn-secondary btn-sm">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
