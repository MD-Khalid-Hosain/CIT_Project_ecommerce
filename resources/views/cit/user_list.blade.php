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
    <div class="row mb-3">
      <div class="col-md-6 ">
        <div class="card">
        <div class="card-header">
          Sale of Last 7 Days
        </div>
        <div class="card-body">



          {{ $seven_days_sale_chart->container() }}
          {{ $seven_days_sale_chart->script() }}

        </div>
      </div>
      </div>
      <div class="col-md-6 ">
        <div class="card">
        <div class="card-header">
           Payment method Details
        </div>
        <div class="card-body">



          {{ $payment_method_chart->container() }}
          {{ $payment_method_chart->script() }}

        </div>
      </div>
      </div>
    </div>






    <div class="row">
      <div class="col-md-12 ">
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
