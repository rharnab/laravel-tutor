@extends('students.index')
@section('content')
<form method="POST" action="{{ route('students.update', $student->id) }}">
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
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="{{ $student->name }}">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="{{ $student->email }}">
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" aria-describedby="phone" name="phone" value="{{ $student->phone }}">
    </div>
    <div class="mb-3">
        <select class="form-select" aria-label="Default select example" name="role">
          <option selected>Role</option>
          <option value="ADMIN">Admin</option>
          <option value="STUDENT">Student</option>
        </select>
       </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection