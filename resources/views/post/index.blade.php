@extends('layouts')
@section('content')
@if(Session::has('message'))
      <p>{{  Session::get('message') }}</p>
@endif
<table class="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">description</th>
      <th scope="col">Create by</th>
      <th scope="col">Option</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)  
      <tr>
        <th scope="row">{{ $post->title }}</th>
        <td>{{ $post->description }}</td>
        <td>{{ $post->user->name}} {{ $post->images->count() }}</td>
        <td>
          <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
          <form action="{{ route('posts.delete', $post->id) }}" method="POST">
             @csrf
             @method('DELETE')
            <button type="submit" onclick="">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
