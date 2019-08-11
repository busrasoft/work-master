@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add product
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
      <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              <label for="name">Product Name:</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}"/>
          </div>

          <div class="form-group">
                <label for="category_id">Product category :</label>
                <select class="form-control" name="category_id">
                    <option value="">Choose Category</option>
            @foreach ($categories as $c)
            <option value="{{ $c->id }}"{{ old('category_id') == $c->id ? ' selected': '' }}>{{ $c->name }}</option>
            @endforeach
                </select>
            </div>

          <div class="form-group">
              <label for="picture">Product picture :</label>
              <input type="file" class="form-control" name="picture"/>
              <span class="text-muted">İmage Only</span>
          </div>

          <select class="form-control" name="status">
            <option value="" selected>Choose Product Status</option>
           <option value="1"{{ old('status') == '1' ? ' selected': '' }}>Yes</option>
           <option value="0"{{ old('status') == '0' ? ' selected': '' }}>No </option>
        </select>

    <input type="radio" name="gender" value="male"> Male<br>
    <input type="radio" name="gender" value="female"> Female<br>
    <input type="radio" name="gender" value="other"> Other<br>

  <br>
          <button type="submit" class="btn btn-primary">Product Add</button>
      </form>
  </div>
</div>
@endsection
