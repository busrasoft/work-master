@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Stock Name</td>
          <td>Stock Status</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
            <a href="{{ url('categories/create') }}" class="btn btn-success">Category Add</a>
<br>
        @foreach($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->status}}</td>
            <td><a href="{{ route('categories.edit',$category->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('categories.destroy',$category->id)}}" method="post"
                    onsubmit="return confirm('Do you really want to remove this item?');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>

       @endforeach

    </tbody>
  </table>
<div>
@endsection
