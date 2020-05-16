@extends('layouts.dashboard')

@section('title')
  Home
@endsection
@section('Home')
  active
@endsection
@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('user/list') }}">Home Page</a>
  </nav>
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-2">
        <div class="card">
        <div class="card-header">
          Total user: {{ $user_lists->total() }}
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>SL. No</th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Created</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($user_lists as $index => $user_list)
                <tr>
                  <td>{{ $user_lists->firstItem() + $index }}</td>
                  <td>{{ $user_list->id }}</td>
                  <td>{{ $user_list->name }}</td>
                  <td>{{ $user_list->email }}</td>
                  <td>*******</td>
                  <td>{{ $user_list->created_at->format('d/m/y') }}</td>
                </tr>
              @endforeach

            </tbody>
          </table>
          {{ $user_lists->links() }}

        </div>
      </div>
      </div>
    </div>
  </div>
@endsection
