@extends('layouts.app')

@section('title', 'Posts Detail')
@section('content')
<div class="container">
    <div class="card">
        <h4 class="card-header font-weight-bold">
            Post Detail
        </h4>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4>Post by: <small class="fs-5">{{ $post->created_by }}</small></h4>
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
            <div>
                <h4>Description:</h4>
                <p class="fs-5">{{ $post->description }}</p>
            </div>
        </div>
    </div>
    <div class="cmd-box mt-2">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @foreach ($post->comments as $comment)
        <div class="border my-1 rounded-2 comment">
            <p class="px-2 py-1 bg-secondary-subtle rounded-top-2">Comment by : {{ $comment->user_id}}</p>
            <div class="d-flex justify-content-between py-1 px-2">
                <p class="cmd-txt">{{ $comment->comment }}</p>
                @if (!empty(Auth::user()))
                <div>
                    <button type="button" class="btn btn-sm btn-success edit-cmt">Edit</button>
                    <form class="d-inline" id="deleteForm">
                        @csrf
                        <input type="hidden" id="commentId" name="id" value="{{ $comment->id }}">
                        <button class="btn btn-danger btn-sm delete-cmt" onclick="return confirm('Do you want to delete?')">Delete</button>
                    </form>
                </div>
                @endif
            </div>
            <div class="edit-form p-2">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="d-flex">
                        <div class="col-10 me-2">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" id="commentId" name="id" value="{{ $comment->id }}">
                            <input type="text" class="form-control" name="comment" value="{{ $comment->comment }}">
                            @error('comment')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @if (!empty(Auth::user()))
    <div>
        <form id="commentForm">
            @csrf
            <label class="form-label mt-3">Write a comment.</label>
            <div class="d-flex">
                <div class="col-10 me-2">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="text" class="form-control" name="comment">
                    @error('comment')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Comment</button>
            </div>
        </form>
    </div>
    @endif
    <div class="mt-2">
        <a href="{{ route('posts.index') }}" type="submit" class="btn btn-secondary btn-sm">Back</a>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#commentForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('comments.store') }}",
                dataType: 'json',
                data: $(this).serialize(),
                success: function(data) {
                    $('#commentForm').trigger("reset");
                    var commentId = data.id;
                    var commentTxt = data.comment
                    $newComment = `
                        <div class="border my-1 rounded-2 comment">
                            <p class="px-2 py-1 bg-secondary-subtle rounded-top-2">Comment by :  @if (!empty(Auth::user())) {{ Auth::user()->id }} @endif</p>
                            <div class="d-flex justify-content-between py-1 px-2">
                            <p class="cmd-txt">${commentTxt}</p>
                            <div>
                                <button type="button" class="btn btn-sm btn-success edit-cmt">Edit</button>
                                <formclass="d-inline" id="deleteForm">
                                @csrf
                                <input type="hidden" id="commentId" name="id" value="${commentId}">
                                <button class="btn btn-danger btn-sm delete-cmt" onclick="return confirm('Do you want to delete?')">Delete</button>
                                </form>
                            </div>
                            </div>
                            <div class="edit-form p-2">
                            <form id="editForm">
                                @csrf
                                @method('PUT')
                                <div class="d-flex">
                                <div class="col-10 me-2">
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" id="commentId" name="id" value="${commentId}">
                                    <input type="text" class="form-control" name="comment" value="${commentTxt}">
                                    @error('comment')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        `;
                    $('.cmd-box').append($newComment);
                },
                error: function(data) {
                    alert('Can\'t comment right now.');
                }
            });
        });

        $(document).on('submit', '#editForm', function(e) {
            e.preventDefault();
            var form = $(this);
            var commentId = form.find('#commentId').val();
            var url = "{{ route('comments.update', ':id') }}".replace(':id', commentId);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                data: $(this).serialize(),
                success: function(data) {
                    form.closest('.edit-form').hide()
                    var commentTxt = form.closest('.edit-form').prev().find('.cmd-txt');
                    commentTxt.text(data.comment);
                },
                error: function(data) {
                    alert('Can\'t update right now.');
                }
            });
        });

        $(document).on('click', '.delete-cmt', function() {
            var form = $(this).closest('.comment').find('#deleteForm');
            var commentId = form.find('#commentId').val();
            var url = "{{ route('comments.delete', ':id') }}".replace(':id', commentId);

            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                data: form.serialize(),
                success: function(data) {
                    var commentBox = form.closest('.comment');
                    commentBox.remove();
                },
                error: function(data) {
                    alert('Can\'t delete right now.');
                }
            });
        });

        $(document).on('click', '.edit-cmt', function() {
            $(this).closest('.d-flex').next('.edit-form').slideToggle();
        });
    });
</script>
@endsection
