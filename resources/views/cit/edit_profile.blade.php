@extends('layouts.dashboard')

@section('title')
  Profile
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('user/list') }}">Home Page</a>
    <a class="breadcrumb-item" href="{{ url('faq/form') }}">Add Faq page</a>
    <a class="breadcrumb-item" href="{{ url('edit/profile') }}">Edit Profile</a>
  </nav>
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-2">
        <div class="card">
          @if (session('change_password'))
            <div class="alert alert-success">
              {{ session('change_password') }}
            </div>
          @endif

          <div class="card-header">
            Change Password
          </div>
          <div class="card-body">

            <form action="{{ route('change_password') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="exampleInputPassword">Old Password</label>

                <input type="password" name="old_password" class="form-control" id="exampleInputPassword"  placeholder="Old Password" >
              </div>
              <div class="form-group">
                <label for="exampleInputNewPassword">New Password</label>

                <input type="password" name="password" class="form-control" id="exampleInputNewPassword"  placeholder="New Password" >
              </div>
              <div class="form-group">
                <label for="exampleInputconfirmPassword">Confirm Password</label>

                <input type="password" name="password_confirmation" class="form-control" id="exampleInputconfirmPassword"  placeholder="New Password" >
              </div>

              <button type="submit" class="btn btn-info">Change</button>
            </form>
            @if ($errors->all())
              <br>
              <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </div>
            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
