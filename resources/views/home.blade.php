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
          <p class="alert alert-success">{{ $message }}</p>
          @endif
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
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