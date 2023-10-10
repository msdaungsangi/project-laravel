@extends('layouts.app')

@section('title', 'Create Post')
@section('content')
<div class="container">
  <div class="card">
    <h4 class="card-header font-weight-bold">
      Post Create
    </h4>
    <div class="card-body">
      @include('posts.postInput')
    </div>
  </div>
</div>
@endsection
