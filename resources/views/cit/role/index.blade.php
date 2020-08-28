{{-- @php
  error_reporting(0);
@endphp --}}
@extends('layouts.dashboard')
@section('title', 'Role Management')


@section('role')
active
@endsection
@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('user/list') }}">Home Page</a>
    <a class="breadcrumb-item" href="{{ url('faq/form') }}">Add Faq page</a>
    <a class="breadcrumb-item" href="{{ url('faq/soft_delete') }}">Trashed</a>
    <a class="breadcrumb-item" href="{{ url('role/manager') }}">Role Manager</a>
  </nav>
@endsection
@section('content')
  <div class="container">
    @can ('edit product')
      <div class="row my-5">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              Role List
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
                      <th>Role Name</th>
                      <th>Permissions</th>
                      </tr>

                </thead>
                <tbody>
                  @forelse ($roles as $role)
                    <tr>
                      <td>{{ $loop->index + 1  }}</td>
                      <td>{{ $role->name  }}</td>
                      <td>
                        @foreach ($role->getPermissionNames() as $permission)
                          <li>{{ $permission }}</li>
                        @endforeach
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="50" class="text-center text-danger">No data found</td>
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
              Add Role

            </div>
            <div class="card-body">
              @if ($errors->all())
                <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </div>
              @endif



              <form action="{{ url('add/role') }}" method="post" >
                @csrf
                <div class="form-group">
                  <label for="product_name">Role Name</label>
                  <input type="text" name="role_name" class="form-control" id="role_name"  placeholder="Enter Role name"  >
                </div>
                <div class="form-group">
                  <label for="role_name">Select Permission</label>
                    @foreach ($permissions as $permission)
                      <label class="ckbox">
                        <input type="checkbox" name="permission[]" value="{{ $permission->name }}">
                        <span>{{ $permission->name }}</span>
                      </label>

                    @endforeach

                </div>

                <button type="submit" class="btn btn-success">Add Role</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              User List
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
                      <th>User Name</th>
                      <th>Role</th>
                      <th>Permissions</th>
                      <th>Action</th>
                      </tr>

                </thead>
                <tbody>
                  @forelse ($users as $user)
                    <tr>
                      <td>{{ $loop->index + 1  }}</td>
                      <td>{{ $user->name  }}</td>
                      <td>
                        @foreach ($user->getRoleNames() as $role_name)
                          <li>{{ $role_name }}</li>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($user->getAllPermissions() as $permission)
                          <li>{{ $permission->name }}</li>
                        @endforeach
                      </td>
                      <td>
                        <a href="{{ url('role/permission/edit') }}/{{ $user->id }}" class="btn btn-info">Edit</a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="50" class="text-center text-danger">No data found</td>
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
              Assign Role

            </div>
            <div class="card-body">
              @if ($errors->all())
                <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </div>
              @endif



              <form action="{{ url('assign/role') }}" method="post" >
                @csrf
                <div class="form-group">
                  <label for="product_name">User Name</label>
                  <select class="form-control" name="user_id">
                    @foreach ($users as $user)

                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="product_name">Role Name</label>
                  <select class="form-control" name="role_name">
                    @foreach ($roles as $role)

                      <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                  </select>
                </div>

                <button type="submit" class="btn btn-success">Assign Role</button>
              </form>
            </div>
          </div>
        </div>
      </div>
@else
      you are not a admin
    @endcan

  </div>
@endsection
