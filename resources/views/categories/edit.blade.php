@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit category
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('categories.update', $category->id) }}">
        @method('PUT')
        @csrf
        <div class="form-group">
          <label for="name">Category Name:</label>
          <input type="text" class="form-control" name="name" value="{{ $category->name }}" />
        </div>
        <div class="form-group">
          <label for="price">Category Status :</label>
          <input type="text" class="form-control" name="status" value="{{ $category->status }}" />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection
