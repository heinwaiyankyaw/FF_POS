@extends('user.layouts.master')
@section('title','Home')
@section('content')
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-light rounded shadow-sm px-3 py-2">Filter by price</span></h5>
            <div class="bg-white p-4 mb-30">
                <form>
                    <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white py-1 px-3">
                        <label class="mt-2" for="price-all">Categories</label>
                        <span class="border rounded font-weight-normal badge pt-1">{{ count($categories) }}</span>
                    </div>

                    <div class="overflow-auto" style="height: 200px;">
                        <div class=" d-flex align-items-center justify-content-between mb-3 pt-2">
                            <a href="{{ route('user#home') }}" class="text-dark"><label class="" for="price-1">All</label></a>
                        </div>
                    @foreach($categories as $category)
                    <div class=" d-flex align-items-center justify-content-between mb-3 pt-2">
                        <a href="{{ route('user#filter',$category->id) }}" class="text-dark"><label class="" for="price-1">{{ $category->name }}</label></a>
                        {{-- <span class="badge border font-weight-normal text-dark me-3">{{ total($category) }}</span> --}}
                    </div>
                    @endforeach
                    </div>
                </form>
            </div>
            <!-- Price End -->
            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                           <a href="{{ route('user#cartList') }}" class="text-decoration-none me-2">
                            <button class="btn btn-sm btn-dark shadow-sm position-relative">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span class="position-absolute top-0 start-100 translate-middle rounded-pills badge bg-danger">
                                    {{ count($cart) }}
                                </span>
                            </button>
                           </a>
                           <a href="{{ route('user#history') }}" class="text-decoration-none">
                            <button class="btn btn-sm btn-dark shadow-sm position-relative" title="Order History">
                                <i class="fa-solid fa-clock-rotate-left">
                                    <span class="position-absolute top-0 start-100 translate-middle rounded-pills badge bg-danger">
                                        {{ count($orders) }}
                                    </span>
                                </i>
                            </button>
                           </a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <select name="sorting" id="sortingOption" class="form-select">
                                    <option value="">Choose Option...</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="row" id="dataList">
                    @if(count($pizzas) != 0)
                    @foreach ($pizzas as $pizza)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4 bg-white" id="myForm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/'.$pizza->image) }}" alt="" style="height: 260px;">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails',$pizza->id) }}" title="View Info"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $pizza->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $pizza->price }} kyats</h5>
                                    {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                        <h4 class="rounded shadow-sm w-50 mx-auto py-5 text-center">There is no Pizza .<i class="fa-solid fa-pizza-slice ms-3"></i></h4>
                    @endif
                </span>

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection

@section('scriptSource')
<script src="{{ asset('js/home.js') }}"></script>
@endsection
