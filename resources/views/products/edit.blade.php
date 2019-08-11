@extends('layout')

@section('content')
<style>
    .uper {
        margin-top: 40px;
    }
</style>
<div class="card uper">
    <div class="card-header">
        Edit product
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
        <form method="post" action="{{ route('products.update', $product->id) }} " enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">product Name:</label>
                <input type="text" class="form-control" name="name" value={{ $product->name }} />
            </div>
            <div class="form-group">
                    <label for="picture">Product picture :</label>
                    <input type="file" class="form-control" name="picture"/>
                    <span class="text-muted">İmage Only</span>
                </div>

            <div class="form-group">
                <label for="category_id">Product Category :</label>
                <select class="form-control" name="category_id">
                    <option value="">Choose Category</option>
                    @foreach ($categories as $c)
                    <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? ' selected': '' }}>{{ $c->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="price">product gender :</label>
                <input type="text" class="form-control" name="gender" value={{ $product->gender }} />
            </div>

            <div class="form-group">
                <label for="price">Product Status :</label>
                <select class="form-control" name="status">
                    <option value="" selected>choose status </option>
                    <option value="1" {{ old('status',$ ->status)==1 ? ' selected':'' }}>Yes</option>
                    <option value="0" {{ old('status',$product->status)==0 ? ' selected':'' }}>No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
