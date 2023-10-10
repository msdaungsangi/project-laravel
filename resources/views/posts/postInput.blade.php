<form @if(isset($post)) action="{{ route('posts.update', $post->id) }}" @else action="{{ route('posts.store') }}" @endif method="POST" enctype="multipart/form-data">
  @csrf
  @if(isset($post))
  @method('PUT')
  @endif
  <div class="form-group">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ isset($post) ? $post->title : old('title')}}">
    @error('title')
    <strong class="text-danger">{{ $message }}</strong>
    @enderror
  </div>
  <div class="form-group">
    <label class="form-label">Description</label>
    <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" placeholder="Description" value="{{ isset($post) ? $post->description : old('description')}}">
    @error('description')
    <strong class="text-danger">{{ $message }}</strong>
    @enderror
  </div>

  <div class="form-group my-2">
    <input type="radio" name="public_flag" id="public" value="true" class="form-check-input" {{ (isset($post) && $post->public_flag === 'Public') || old('public_flag') == 'true' ? 'checked' : '' }}>
    <label for="adminRole" class="form-check-label">Public</label>

    <input type="radio" name="public_flag" id="private" value="false" class="form-check-input" {{ (isset($post) && $post->public_flag === 'Private') || old('public_flag') == 'false' ? 'checked' : '' }}>
    <label for="userRole" class="form-check-label">Private</label>
    @error('public_flag')
    <strong class="text-danger">{{ $message }}</strong>
    @enderror
  </div>

  <div class="d-flex justify-content-between mt-2">
    <a href="{{ route('posts.index') }}" type="submit" class="btn btn-secondary">Back</a>
    <button type="submit" class="btn btn-primary">@if(isset($post)) Update @else Create @endif </button>
  </div>
</form>