@extends('layouts.app')

@section('title', 'Edit Posts')
@section('content')
<div class="container">
  <div class="card">
    <h4 class="card-header font-weight-bold">
      Post Edit
    </h4>
    <div class="card-body">
      @include('posts.postInput')
    </div>
  </div>
</div>
@endsection
