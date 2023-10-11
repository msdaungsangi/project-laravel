@extends('layouts.app')

@section('title', 'Posts')
@section('content')
<div class="container">
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if (!empty(Auth::user()))
  <div class="d-flex">
    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm mb-3">Create Post</a>
  </div>
  @endif
  @foreach ($posts as $post)
  <div class="card mt-2">
    <div class="card-header d-flex justify-content-between">
      <h4><small class="me-2">
          @if($post->public_flag === 'Public')
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
          </svg>
          @else
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lock" viewBox="0 0 16 16">
            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 5.996V14H3s-1 0-1-1 1-4 6-4c.564 0 1.077.038 1.544.107a4.524 4.524 0 0 0-.803.918A10.46 10.46 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h5ZM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z" />
          </svg>
          @endif
        </small><small class="text-success">Post by</small> {{ $post->created_by }}</h4>
      <div>
        <a href="{{ route('posts.detail', $post->id) }}" class="btn btn-secondary btn-sm">View</a>
        @if(Auth::user())
        @if(Auth::user()->id === $post->created_by)
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success btn-sm">
          Edit
        </a>
        <form action="{{ route('posts.delete') }}" class="d-inline">
          @csrf
          <input type="text" hidden value="{{ $post->id }}" name="post_id">
          <button class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete?')">Delete</button>
        </form>
        @endif
        @endif
      </div>
    </div>
    <div class="card-body">
      <h5>{{ $post->title }}</h5>
      <p>{{ $post->description }}</p>
      <small>{{ $post->created_at }}</small>
    </div>
  </div>
  @endforeach
</div>
@endsection
