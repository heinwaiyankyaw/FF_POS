@extends('admin.layouts.master')

@section('title','Order List')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Orders List</h2>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="bg-white py-2 px-3 rounded shadow-sm text-center">
                        <h3 class="mt-1"><i class="fa-solid fa-database"></i> {{ count($orders) }}</h3>
                    </div>
                    <form action="{{ route('admin#changeStatus') }}" method="post" class="w-50 justify-content-start">
                        @csrf
                        <div class="d-flex align-items-center">
                            <label for="" class="pr-2 mt-2">Order Sorting</label>
                            <select name="orderStatus" class="form-control w-25 shadow-sm rounded mr-1">
                                <option value="">All</option>
                                <option value="0" @if(request('orderStatus')=='0' ) selected @endif>Pending</option>
                                <option value="1" @if(request('orderStatus')=='1' ) selected @endif>Confirm</option>
                                <option value="2" @if(request('orderStatus')=='2' ) selected @endif>Reject</option>
                            </select>
                            <button class="btn btn-sm shadow-sm bg-dark text-white rounded" type="submit" id="btnOrderStatus">Search</button>
                        </div>
                    </form>
                    <div class="d-flex text-center">
                        @if(request('key') != null)
                        <h4 class="text-secondary">Search key : <span class="text-danger">{{ request('key') }}</span></h4>
                        @endif
                    </div>
                    <div class="w-25">
                        <form action="{{ route('order#list') }}" method="get">
                            {{-- @csrf --}}
                            <div class="input-group">
                                <input type="text" name='key' class="form-control" placeholder="Search Here..." value="{{ request('key') }}">
                                <button type="submit" class="text-white btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-1 bg-white py-2 rounded shadow-sm text-center">
                        <h3 class="mt-1"><i class="fa-solid fa-database"></i> {{ $orders->total() }}</h3>
            </div>
            <div class="col-4 py-2 d-flex">
                <label for="">Order Sorting</label>
                <select name="status" id="" class="form-control">
                    <option value="">All</option>
                    <option value="0">Pending</option>
                    <option value="1">Confirm</option>
                    <option value="2">Reject</option>
                </select>
            </div>
            <div class="col-2 offset-2 d-flex align-items-center text-center">
                @if(request('key') != null)
                <h4 class="text-secondary">Search key : <span class="text-danger">{{ request('key') }}</span></h4>
                @endif
            </div>
            <div class="col-2 offset-1">
                <form action="{{ route('order#list') }}" method="get">
                    <div class="input-group">
                        <input type="text" name='key' class="form-control" placeholder="Search Here..." value="{{ request('key') }}">
                        <button type="submit" class="text-white btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div> --}}
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2 text-center">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Order Code</th>
                        <th>Order Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="dataList">
                    @foreach ($orders as $order)
                    <tr class="tr-shadow">
                        <input type="hidden" name="orderId" class="orderId" value="{{ $order->id }}">
                        <td>{{ $order->user_id }}</td>
                        <td>{{ $order->user_name }}</td>
                        <td><a href="{{ route('admin#listInfo',$order->order_code) }}">{{ $order->order_code }}</a></td>
                        <td>{{ $order->created_at->format('M-j-Y') }}</td>
                        <td>{{ $order->total_price }} kyats</td>
                        <td>
                            <select class="form-control statusChange" name="status">
                                <option value="0" @if($order->status == 0) selected @endif>Pending</option>
                                <option value="1" @if($order->status == 1) selected @endif>Confirm</option>
                                <option value="2" @if($order->status == 2) selected @endif>Reject</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>

            {{-- <div class="mt-3">
                        {{ $orders->appends(request()->query())->links() }}
        </div> --}}
    </div>
</div>
</div>
</div>
</div>
@endsection
@section('scriptSource')
<script src="{{ asset('js/orderList.js') }}"></script>
@endsection
