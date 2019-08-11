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
          <td>Image</td>
          <td>Stock Status</td>
          <td>Category Name</td>
          <td>Stock Gender</td>
          <td>Stock Edit</td>
          <td colspan="2">Delete</td>

        </tr>
    </thead>
    <tbody>  
            <a href="{{ url('products/create') }}" class="btn btn-success">Product Add</a>
<br>
        @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td><img src="{{ $product->picture }}" width="48" /></td>
            <td>{{$product->status}}</td>
            <td>{{$product->category_id}}</td>
            <td>{{$product->gender}}</td>
            <td><a href="{{ route('products.edit',$product->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('products.destroy',$product->id)}}" method="post">
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
