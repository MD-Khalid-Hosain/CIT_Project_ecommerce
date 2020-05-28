@extends('layouts.frontend')
@section('title', 'Cart Page')
@section('about')
active
@endsection

@section('content')
  <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  @if ($errors->all())
                    <div class="alert alert-danger">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </div>
                  @endif

                    <form action="{{ url('update/cart') }}" method="post">
                      @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach (cart_product_show() as $cart_product)
                                <tr>
                                    <td class="images"><img src="{{ asset('uploads/product_thumbnail') }}/{{ $cart_product->relationWithProductTable->product_thumbnail_photo }}"  alt="{{ $cart_product->relationWithProductTable->product_thumbnail_photo }}"></td>
                                    <td class="product"><a href="{{ url('product') }}/{{ $cart_product->relationWithProductTable->product_slug }}" target= "_blank" >{{ $cart_product->relationWithProductTable->product_name }}</a></td>
                                    <td class="ptice">${{ $cart_product->relationWithProductTable->product_price }}</td>
                                    <input type="hidden" value="{{ $cart_product->id }}" name="cart_id[]">
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" value="{{ $cart_product->amount }}" name="cart_quantity[]">
                                    </td>
                                    <td class="total">${{ $cart_product->relationWithProductTable->product_price * $cart_product->amount }}</td>
                                    <td class="remove"><a href="{{ url('delete/from/cart') }}/{{ $cart_product->id }}"><i class="fa fa-times"></i></a></i></td>
                                </tr>
                              @endforeach


                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button type="submit" >Update Cart</button>
                                          </form>
                                        </li>
                                        <li><a href="{{ url('/') }}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div>
                                        <input type="text" placeholder="Cupon Code" id="coupon-text" value="{{ $coupon_name ?? "" }}">
                                        <a class="btn btn-danger" id="apply-btn">Apply Cupon</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>${{ cart_subtotal() }}</li>
                                        @isset($coupon_discount)

                                          <li><span class="pull-left"> Coupon Discount</span> {{ $coupon_discount }}%</li>
                                        @endisset
                                        <li><span class="pull-left"> Total </span>
                                          @isset($coupon_discount)
                                            ${{ $total_from_cart = (cart_subtotal() - (($coupon_discount/100) * cart_subtotal())) }}
                                          @else
                                            ${{ $total_from_cart = cart_subtotal() }}
                                          @endisset
                                        </li>
                                    </ul>
                                      <form  action="{{ url('checkout') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="coupon_name_from_cart" value="{{ $coupon_name ?? "" }}">
                                        <input type="hidden" name="total_from_cart" value="{{ $total_from_cart }}">
                                        <button type="submit" class="btn btn-danger">Proceed to Checkout</button>
                                      </form>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection
@section('footer_script')
  {{-- my javascript function --}}
  <script type="text/javascript">
    $(document).ready(function(){
      $('#apply-btn').click(function(){
        var coupon_text = $('#coupon-text').val();
        var link_to_go = "{{ url('cart') }}/"+coupon_text;
        window.location.href = link_to_go;
      });
    });
  </script>
@endsection
