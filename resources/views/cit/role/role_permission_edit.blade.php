{{-- @php
  error_reporting(0);
@endphp --}}
@extends('layouts.dashboard')
@section('title', 'Role Management')
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
    <div class="row">
      <div class="col-md-4 m-auto">
        <div class="card">
          <div class="card-header">
            Change Permission- {{ $user->name }}

          </div>
        
            <div class="card-body">
              @if ($errors->all())
                <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </div>
              @endif



              <form action="{{ url('change/permission/edit') }}" method="post" >
                @csrf

                <div class="form-group">
                  <input type="hidden" name="user_id" value="{{ $user->id }}">
                  <label for="role_name">Select Permission</label>
                    @foreach ($permissions as $permission)

                      <label class="ckbox">
                        <input {{ ($user->hasPermissionTo($permission->name)) ? "checked" : "" }} type="checkbox" name="permission[]" value="{{ $permission->name }}">
                        <span>{{ $permission->name }}</span>
                      </label>

                    @endforeach

                </div>

                <button type="submit" class="btn btn-success">Change Permission</button>
              </form>
            </div>
          

        </div>
      </div>
    </div>
  </div>
@endsection
