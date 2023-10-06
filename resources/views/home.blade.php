@extends('layouts.app')
@section('title', 'Home Dashboard')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>
        <div class="card-body">
          @if ($message = Session::get('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          @if (session('status'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          <h2>Hello, {{ Auth::user()->name }}.</h2>
          <a class="btn btn-sm btn-outline-primary" href="{{ route('pass.change') }}">Change Password</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
