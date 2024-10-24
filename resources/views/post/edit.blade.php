@extends('layouts')
@section('content')
<form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
    @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="Title" value="{{ $post->title }}">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="" cols="100" rows="10">{{ $post->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" aria-describedby="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection