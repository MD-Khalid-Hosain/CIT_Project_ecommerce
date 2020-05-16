@extends('layouts.dashboard')

@section('title')
  Edit Category
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('user/list') }}">Home Page</a>
    <a class="breadcrumb-item" href="{{ url('faq/form') }}">Add Faq page</a>
    <a class="breadcrumb-item" href="{{ url('faq/soft_delete') }}">Trashed</a>
    <a class="breadcrumb-item" href="{{ url('category') }}">Category</a>
    <a class="breadcrumb-item" href="#">Edit Category</a>
  </nav>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-4a">
        <div class="card">
          <div class="card-header">
            Category Edit

          </div>
          <div class="card-body">
            @if ($errors->all())
              <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </div>
            @endif


            <form action="{{ route('category.update', $category->id ) }}" method="post" enctype="multipart/form-data">
              {{ method_field('PUT') }}
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Category Name</label>
                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1"  placeholder="Enter category" value="{{ $category->category_name }}">
                @error ('category_name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputphoto">Category Photo</label>
                <input type="file" name="category_photo" class="form-control" id="exampleInputphoto"   >
                @error ('category_photo')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <button type="submit" class="btn btn-success">Edit Category</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
