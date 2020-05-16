@extends('layouts.dashboard')

@section('title')
  Trashed
@endsection
@section('trashed')
  active
@endsection
@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('user/list') }}">Home Page</a>
    <a class="breadcrumb-item" href="{{ url('faq/form') }}">Add Faq page</a>
    <a class="breadcrumb-item" href="{{ url('faq/soft_delete') }}">Trashed</a>
  </nav>
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-2">
        <div class="card">
          <div class="card-header">
            Trashed User list
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>

                  <tr>
                    <th>SL. No</th>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>

              </thead>
              <tbody>

                @forelse ($trash_lists as $trash_list)


                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $trash_list->id }}</td>
                    <td>{{ $trash_list->email }}</td>
                    <td>{{ $trash_list->number }}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" class="btn btn-info btn-sm" href="{{ url('/faq/undo') }}/{{ $trash_list->id }}">Undo</a>
                        <a type="button" class="btn btn-danger btn-sm" href="{{ url('/faq/force/delete') }}/{{ $trash_list->id }}">Delete</a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                  <td colspan="15" class="text-center">No Deleted Data Available</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
