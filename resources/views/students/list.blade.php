@extends('layouts')
@section('content')
@if(Session::has('message'))
      <p>{{  Session::get('message') }}</p>
@endif
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">email</th>
      <th scope="col">phone</th>
      <th scope="col">posts</th>
      <th scope="col">Option</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($students as $student)  
      <tr>
        <th scope="row">{{ $student->name }}</th>
        <td>{{ $student->email }}</td>
        <td>{{ $student->phone }}</td>
        <td>{{ $student->posts->count() }}</td>
        <td>
          <a href="{{ route('students.edit', $student->id) }}">Edit</a>
          <form action="{{ route('students.delete', $student->id) }}" method="POST">
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