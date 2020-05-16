@extends('layouts.dashboard')

@section('title')
  Category
@endsection
@section('product')
  active
@endsection
@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('user/list') }}">Home Page</a>
    <a class="breadcrumb-item" href="{{ url('faq/form') }}">Add Faq page</a>
    <a class="breadcrumb-item" href="{{ url('faq/soft_delete') }}">Trashed</a>
    <a class="breadcrumb-item" href="{{ url('category') }}">Category</a>
  </nav>
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Category list
            @if (session('DeleteStatus'))
                <div class="alert alert-danger">
                  {{ session('DeleteStatus') }}
                </div>
            @endif
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>

                  <tr>
                    <th>SL. No</th>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Short Description</th>
                    <th>Product Long Description</th>
                    <th>Category Name</th>
                    <th>Product Photo</th>
                    <th>Created</th>
                    <th>Update</th>
                    <th>Action</th>

                  </tr>

              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4a">
        <div class="card">
          <div class="card-header">
            Category Form

          </div>
          <div class="card-body">
            @if ($errors->all())
              <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </div>
            @endif



            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="category_id">Category Name</label>
                <select class="form-control" name="category_id" id="category_id">
                  <option value="">--Select One--</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>

                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" class="form-control" id="product_name"  placeholder="Enter Product name"  >
              </div>
              <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="text" name="product_price" class="form-control" id="product_price"  placeholder="Enter Product price"  >
              </div>
              <div class="form-group">
                <label for="product_short_description">Product Short Description</label>
                <textarea name="product_short_description" class="form-control" rows="4" id="product_short_description" ></textarea>
              </div>
              <div class="form-group">
                <label for="product_long_description">Product Long Description</label>
                <textarea name="product_long_description" class="form-control" rows="4" id="product_long_description" ></textarea>
              </div>

              <div class="form-group">
                <label for="product_thumbnail_photo">Product Photo</label>
                <input type="file" name="product_thumbnail_photo" class="form-control" id="product_thumbnail_photo"   >

              </div>
              <div class="form-group">
                <label for="product_multiple_photo">Product Multiple Photo</label>
                <input type="file" name="product_multiple_photo[]" class="form-control" id="product_multiple_photo" multiple  >

              </div>

              <button type="submit" class="btn btn-success">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
