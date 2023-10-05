@extends('layouts')
@section('title', 'Edit User')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <h4 class="card-header font-weight-bold">
                User Edit
            </h4>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label  class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="" placeholder="name" value="{{ $user->name }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label  class="form-label">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="" placeholder="name@example.com" value="{{ $user->email }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group my-2">
                        <input type="radio" name="role" id="adminRole" value="1" class="form-check-input" {{ $user->role == "1" ? 'checked' : '' }}>
                        <label for="adminRole" class="form-check-label">Admin</label>
                        
                        <input type= "radio" name="role" id="userRole" value="2" class="form-check-input" {{ $user->role == "2" ? 'checked' : '' }}>
                        <label for="userRole" class="form-check-label">Member</label>
                        
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label  class="form-label">Image</label>
                        <input type="file" name="img" class="form-control  @error('img') is-invalid @enderror"
                            id="">
                        @error('img')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label  class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="" placeholder="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                        <a href="{{ route('users.index') }}" type="submit" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
