@extends('layouts.app')
@section('title', 'Change Password')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @if ($message = Session::get('error'))
      <p class="alert alert-danger">{{ $message }}</p>
      @endif
      <div class="card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
          <form action="{{ route('pass.update') }}">
            @csrf
            <div class="form-group">
              <label class="form-label">Old Password</label>
              <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="" placeholder="old password" value="{{old('old_password')}}">
              @error('old_password')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label">New Password</label>
              <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="" placeholder="new password" value="{{old('new_password')}}">
              @error('new_password')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label">Confirm Password</label>
              <input type="password" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="" placeholder="confirm password" value="{{old('confirm_password')}}">
              @error('new_password_confirmation')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="d-flex justify-content-between mt-2">
              <a href="{{ route('home') }}" type="submit" class="btn btn-secondary">Back</a>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
