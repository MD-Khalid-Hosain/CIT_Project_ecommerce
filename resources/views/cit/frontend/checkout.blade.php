@extends('layouts.frontend')
@section('title', 'Checkout Page')



@section('content')
  <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                        <form  method="post" action="{{ url('checkout/post') }}">
                          @csrf
                          <small>You are login as: {{ Auth::user()->name }} </small>
                            <div class="row">

                                <div class="col-12">
                                    <p>Full Name</p>
                                    <input type="text" name="full_name" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" name="email_address" value="{{ Auth::user()->email }}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text" name="phone_number" >
                                </div>
                                <div class="col-6">
                                    <p>Country *</p>
                                  <select class="" name="country_id" id="country_list">
                                    <option value="">select</option>
                                    @foreach ($countries as $country)

                                      <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                    @endforeach
                                    <
                                  </select>
                                </div>
                                <div class="col-sm-6">
                                  <p>Town/City *</p>
                                  <select class="" name="city_id" id="city_list">
                                    <option >select</option>


                                  </select>
                                </div>
                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text" name="address" >
                                </div>

                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>

                          <ul class="total-cost">
                            @foreach (cart_product_show() as $cart_product)
                            <li>{{ $cart_product->relationWithProductTable->product_name }}<span class="pull-right">${{ $cart_product->relationWithProductTable->product_price *$cart_product->amount }}</span></li>
                          @endforeach
                            <input type="hidden" name="sub_total" value="{{ cart_subtotal() }}">
                            <input type="hidden" name="total" value="{{ $total_from_cart}}">
                            <input type="hidden" name="coupon_name" value="{{ $coupon_name_from_cart ?? "nai" }}">
                            <li>Subtotal <span class="pull-right"><strong>${{ cart_subtotal() }}</strong></span></li>
                            <li>Coupon <span class="pull-right"><strong>{{ $coupon_name_from_cart ?? "nai" }}</strong></span></li>

                            <li>Total<span class="pull-right">${{ $total_from_cart }}</span></li>
                          </ul>
                        <ul class="payment-method">

                          <li>
                            <input id="delivery" type="radio" name="payment_method" checked value="1">
                            <label for="delivery">Cash on Delivery</label>
                          </li>
                            <li>
                                <input id="card" type="radio" name="payment_method" value="2">
                                <label for="card">Credit Card/Paypal</label>
                            </li>
                        </ul>
                        <button type="submit">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection
@section('footer_script')
    <script type="text/javascript">
      $(document).ready(function(){
        $('#country_list').change(function(){
          var country_id = $(this).val();
          // ajaxSetup start
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          // ajaxSetup end
          // ajaxSetup request start
          $.ajax({
            type: 'POST',
            url: '/get/city/list',
            data:{country_id:country_id},
            success:function(data){
              $('#city_list').html(data);
            }
          });
          // ajaxSetup request end
        });
      });
    </script>
@endsection
