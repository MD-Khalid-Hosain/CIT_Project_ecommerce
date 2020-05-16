@extends('layouts.dashboard')

@section('title')
  Edit Faq
@endsection

@section('breadcrumb')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ url('/faq/form') }}">Faq Form</a>
    <a class="breadcrumb-item" >ID = {{ $faq_lists->id }}</a>
  </nav>
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-2">
        <div class="card">
          <div class="card-header">
            User Edit Form
          </div>
          <div class="card-body">

            <form action="{{ url('/faq/form/update') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="hidden" name="faq_id" value="{{ $faq_lists->id }}">
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"  placeholder="Enter email" value="{{ $faq_lists->email }}">
                @error ('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputphone">Phone Number</label>
                <input type="text"  name="number" class="form-control" id="exampleInputphone"  placeholder="Enter phone number" value="{{ $faq_lists->number }}">
              </div>
              <button type="submit" class="btn btn-success">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
