@extends('layouts.dashboard')

@section('title')
  Coupon
@endsection
@section('coupon')
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
      <div class="col-md-9 mb-3">
        <div class="card">
          <div class="card-header">
            Valid Coupon list
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

                    <th>Coupon Name</th>
                    <th>Coupon Discount</th>
                    <th>Coupon Validity Till</th>
                    <th>Coupon Validity Status</th>
                    <th>Validity in Days</th>
                    <th>Created</th>
                    <th>Action</th>

                  </tr>

              </thead>
              <tbody>
                @forelse ($valid_coupon as $coupon)
                  <tr>
                    <td>{{ $loop->index + 1  }}</td>
                    <td>{{ $coupon->coupon_name  }}</td>
                    <td>{{ $coupon->coupon_discount  }}%</td>
                    <td>{{ $coupon->validity_till  }}</td>
                    <td>
                      @if ( $coupon->validity_till >=\Carbon\Carbon::now()->format('Y-m-d'))
                        <span class="badge badge-success">Good</span>
                        @else
                          <span class="badge badge-danger">Bad</span>
                      @endif
                    </td>
                    <td>
                      @if ( $coupon->validity_till >=\Carbon\Carbon::now()->format('Y-m-d'))
                        <span class="badge badge-success">{{ \Carbon\Carbon::parse($coupon->validity_till)->diffInDays() }} days left</span>
                        @else
                          <span class="badge badge-danger">ecpired {{ \Carbon\Carbon::parse($coupon->validity_till)->diffInDays() }} days ago</span>
                      @endif

                    </td>
                    <td>{{ $coupon->created_at  }}</td>

                  </tr>
                @empty
                  <span> Coupon Avilable</span>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            Add Coupon

          </div>
          <div class="card-body">
            @if ($errors->all())
              <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </div>
            @endif



            <form action="{{ route('coupon.store') }}" method="post" >
              @csrf

              <div class="form-group">
                <label for="product_name">Coupon Name</label>
                <input type="text" name="coupon_name" class="form-control" id="product_name"  placeholder="Enter Coupon name"  >
              </div>
              <div class="form-group">
                <label for="product_price">Discount Amount (%)</label>
                <input type="text" name="coupon_discount" class="form-control" id="product_price"  placeholder="Enter Coupon Dscount"  >
              </div>
              <div class="form-group">
                <label for="product_price">Validity Till</label>
                <input type="date" name="validity_till" class="form-control" id="product_price" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"  >
              </div>


              <button type="submit" class="btn btn-success">Add Coupon</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
              In Valid Coupon list
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

                    <th>Coupon Name</th>
                    <th>Coupon Discount</th>
                    <th>Coupon Validity Till</th>
                    <th>Coupon Validity Status</th>
                    <th>Validity in Days</th>
                    <th>Created</th>
                    <th>Action</th>

                  </tr>

              </thead>
              <tbody>
                @forelse ($in_valid_coupon as $coupon)
                  <tr>
                    <td>{{ $loop->index + 1  }}</td>
                    <td>{{ $coupon->coupon_name  }}</td>
                    <td>{{ $coupon->coupon_discount  }}%</td>
                    <td>{{ $coupon->validity_till  }}</td>
                    <td>
                      @if ( $coupon->validity_till >=\Carbon\Carbon::now()->format('Y-m-d'))
                        <span class="badge badge-success">Good</span>
                        @else
                          <span class="badge badge-danger">Bad</span>
                      @endif
                    </td>
                    <td>
                      @if ( $coupon->validity_till >=\Carbon\Carbon::now()->format('Y-m-d'))
                        <span class="badge badge-success">{{ \Carbon\Carbon::parse($coupon->validity_till)->diffInDays() }} days left</span>
                        @else
                          <span class="badge badge-danger">ecpired {{ \Carbon\Carbon::parse($coupon->validity_till)->diffInDays() }} days ago</span>
                      @endif

                    </td>
                    <td>{{ $coupon->created_at  }}</td>

                  </tr>
                @empty
                  <span> Coupon Avilable</span>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
