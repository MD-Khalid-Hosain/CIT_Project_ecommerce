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
            Customer Home
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>SL. No</th>
                  <th>Order Id</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Sub Total</th>
                  <th>Total</th>
                  <th>Created</th>
                  <th>Download Invoice</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($customer_orders as $index => $customer_order)
                  <tr>
                    <td>{{ $customer_orders->firstItem() + $index }}</td>
                    <td>{{ $customer_order->id }}</td>
                    <td>{{ $customer_order->full_name }}</td>
                    <td>{{ $customer_order->email_address }}</td>
                    <td>{{ $customer_order->address }}</td>
                    <td>{{ $customer_order->sub_total }}$</td>
                    <td>{{ $customer_order->total }}$</td>
                    <td>{{ $customer_order->created_at->format('d/m/y') }}</td>
                    <td>
                      <a href="{{ url('order/download') }}/{{ $customer_order->id }}" class="btn btn-success">Download</a>
                      <a href="{{ url('send/sms') }}/{{ $customer_order->id }}" class="btn btn-info">Send SMS</a>
                    </td>
                  </tr>
                  @empty
                @endforelse

              </tbody>
            </table>
            {{ $customer_orders->links() }}

          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
