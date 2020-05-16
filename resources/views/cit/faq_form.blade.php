@extends('layouts.dashboard')

@section('title')
  Add Faq
@endsection
@section('addfaq')
  active
@endsection
@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('user/list') }}">Home Page</a>
    <a class="breadcrumb-item" href="{{ url('faq/form') }}">Add Faq page</a>
  </nav>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          User list
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
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Created</th>
                  <th>Updated</th>
                  <th>Action</th>

                </tr>

            </thead>
            <tbody>
              @forelse ($user_info as $user_informatons)

                <tr>
                  <td>{{ $loop->index + 1}}</td>
                  <td>{{ $user_informatons->id }}</td>

                  <td>{{ $user_informatons->email }}</td>
                  <td>{{ $user_informatons->number }}</td>
                  <td>{{ Carbon\Carbon::parse($user_informatons->created_at)->format('Y-m-d') }}</td>
                  <td>
                    @if (isset($user_informatons->updated_at))
                      {{ $user_informatons->updated_at->diffForHumans() }}
                    @else
                      --
                    @endif

                  </td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a type="button" class="btn btn-info btn-sm" href="{{ url('/faq/form/edit') }}/{{ $user_informatons->id }}">Edit</a>
                      <a type="button" class="btn btn-danger btn-sm" href="{{ url('/faq/form/delete') }}/{{ $user_informatons->id }}">Delete</a>
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
          User Form
          @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
          @endif
        </div>
        <div class="card-body">
          @if ($errors->all())
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </div>
          @endif


          <form action="{{ url('/faq/form/post') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail1"  placeholder="Enter email" value="{{ old('email') }}">
              @error ('email')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputphone">Phone Number</label>
              <input type="text"  name="number" class="form-control" id="exampleInputphone"  placeholder="Enter phone number" value="{{ old('number') }}">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
