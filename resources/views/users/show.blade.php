@extends('layouts.app')

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
      <div class="row mt-3">
        @foreach ($user->posts as $post)
        <div class="col-4 mb-2">
          <div class="card">
            <div class="d-flex justify-content-between card-header">
              <h5>Post by: <small class="fs-5">{{ $user->name }}</small></h5>
              <div>
                <small>{{ $post->created_at }}</small>
                <small class="ms-2 border border-primary rounded-2 pb-1 px-1">
                  @if($post->public_flag === 'Public')
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                  </svg>
                  @else
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lock" viewBox="0 0 16 16">
                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 5.996V14H3s-1 0-1-1 1-4 6-4c.564 0 1.077.038 1.544.107a4.524 4.524 0 0 0-.803.918A10.46 10.46 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h5ZM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z" />
                  </svg>
                  @endif
                </small>
              </div>
            </div>
            <div class="card-body">
              <div>
                <h6>Description:</h6>
                <p>{{ $post->description }}</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
