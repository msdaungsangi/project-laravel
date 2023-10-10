@extends('layouts.app')

@section('title', 'Edit Posts')
@section('content')
<div class="container">
  <div class="card">
    <h4 class="card-header font-weight-bold">
      Post Edit
    </h4>
    <div class="card-body">
      <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ $post->title }}">
          @error('title')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" placeholder="Description" value="{{ $post->description}}">
          @error('description')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group my-2">
          <input type="radio" name="public_flag" id="public" value="true" class="form-check-input" {{ $post->public_value == true ? 'checked' : '' }}>
          <label for="adminRole" class="form-check-label">Public</label>
          <input type="radio" name="public_flag" id="private" value="false" class="form-check-input" {{ $post->public_value == false ? 'checked' : '' }}>
          <label for="userRole" class="form-check-label">Private</label>
          @error('public_flag')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="d-flex justify-content-between mt-2">
          <a href="{{ route('posts.index') }}" type="submit" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
