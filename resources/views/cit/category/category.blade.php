@extends('layouts.dashboard')

@section('title')
  Category
@endsection
@section('category')
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
                    <th>Category Name</th>
                    <th>Added by</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Photo</th>
                    <th>Action</th>

                  </tr>

              </thead>
              <tbody>
                @forelse ($category_lists as $category_list)

                  <tr>
                    <td>{{ $loop->index + 1}}</td>
                    <td>{{ $category_list->id }}</td>

                    <td>{{ $category_list->category_name }}</td>
                    {{-- <td>{{ App\User::find($category_list->added_by)->name }}</td> --}}
                    <td>{{ $category_list->connect_to_user_table->name }}</td>
                    <td>{{ $category_list->created_at->format('d/m/Y') }}</td>
                    <td>
                      @if (isset($category_list->updated_at))
                        {{ $category_list->updated_at->diffForHumans() }}
                      @else
                        --
                      @endif

                    </td>
                    <td>
                      <img width="50" src="{{ asset('uploads/category') }}/{{ $category_list->category_photo }}" alt="{{ $category_list->category_photo }}">
                    </td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" class="btn btn-info btn-sm" href="{{ route('category.edit', $category_list->id ) }}">Edit</a>
                        <form action="{{ URL::route('category.destroy', $category_list->id) }}" method="POST">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button>Delete User</button>
                      </form>
                      
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="15" class="text-center">No data Available</td>
                  </tr>
                @endforelse
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


            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Category Name</label>
                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1"  placeholder="Enter category" value="{{ old('category_name') }}">
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

              <button type="submit" class="btn btn-success">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
