@extends('layouts.app')

@section('title', 'Create Post')
@section('content')
<div class="container">
  <div class="card">
    <h4 class="card-header font-weight-bold">
      Post Create
    </h4>
    <div class="card-body">
      <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{old('title')}}">
          @error('title')
          <strong class="text-danger">{{ $message }}</strong>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" placeholder="Description" value="{{old('description')}}">
          @error('description')
          <strong class="text-danger">{{ $message }}</strong>
          @enderror
        </div>

        <div class="form-group my-2">
          <input type="radio" name="public_flag" id="public" value="true" class="form-check-input" {{ old('public_flag') == true ? 'checked' : '' }}>
          <label for="adminRole" class="form-check-label">Public</label>
          <input type="radio" name="public_flag" id="private" value="false" class="form-check-input" {{ old('public_flag') == false ? 'checked' : '' }}>
          <label for="userRole" class="form-check-label">Private</label>
          @error('public_flag')
          <strong class="text-danger">{{ $message }}</strong>
          @enderror
        </div>
        @if (empty(Auth::user()))
        <div class="d-flex justify-content-between mt-2">
          <a href="{{ route('posts.index') }}" type="submit" class="btn btn-secondary">Back</a>
          <a href="{{ route('login') }}" type="submit" class="btn btn-primary">Create</a>
        </div>
        @else
        <div class="d-flex justify-content-between mt-2">
          <a href="{{ route('posts.index') }}" type="submit" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
        @endif
      </form>
    </div>
  </div>
</div>
@endsection
