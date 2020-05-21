@extends('layouts.dashboard')

@section('title')

@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('/faq/form') }}">Faq Form</a>

  </nav>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Customer Dashboard
          </div>
          <div class="card-body">
            <h1>Welcome Customer</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
