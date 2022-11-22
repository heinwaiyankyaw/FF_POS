@extends('user.layouts.master')
@section('title','Add to Cart')
@section('content')
        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                      @if(count($cartLists) != 0)
                      <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Image</th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach($cartLists as $cartList)
                            <tr>
                                <td class="align-middle"><img src="{{ asset('storage/'.$cartList->pizza_image) }}" alt="" style="width: 50px; height:50px;" class="rounded"> </td>
                                <td class="align-middle">{{ $cartList->pizza_name }}
                                <input type="hidden" name="productId" value="{{ $cartList->product_id }}" id="productId">
                                <input type="hidden" name="userId" value="{{ $cartList->user_id }}" id="userId">
                                <input type="hidden" name="cartId" value="{{ $cartList->id }}" id="cartId">
                                </td>
                                <td class="align-middle" id="price">{{ $cartList->pizza_price }} kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-minus" >
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-white border-0 text-center" value="{{ $cartList->qty }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $cartList->pizza_price*$cartList->qty }} kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                      @else
                        <h3 class="text-center mt-md-5 text-muted">There is no product in your cart.</h3>
                      @endif
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-light pr-3">Cart Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6 id="subTotalPrice">{{ $totalPrice }} kyats</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Delivery</h6>
                                <h6 class="font-weight-medium">5000 kyats</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5 id="finalPrice">{{ $totalPrice+5000 }} kyats</h5>
                            </div>
                            <button class="btn btn-block btn-warning font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                            <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">Clear Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
@endsection
@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection
