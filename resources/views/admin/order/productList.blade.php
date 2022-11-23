@extends('admin.layouts.master')

@section('title','Order List')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->

        <div class="card mt-4 w-50 rounded shadow-sm pl-4">
            <div class="card-body">
                <div class="card-title" style="border-bottom:1px solid black;">
                   <div class="pb-3">
                    <h3><i class="fa-solid fa-clipboard mr-1"></i>Orders List</h3>
                    <small class="text-warning">
                        <i class="fa-solid fa-triangle-exclamation"></i>Include Delivery Charges
                    </small>
                   </div>
                </div>
                <div class="row">
                    <div class="col">
                        <i class="fa-solid fa-user mr-1"></i>UserName
                    </div>
                    <div class="col">
                        {{ strtoupper($orderList[0]->user_name) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <i class="fa-solid fa-barcode mr-1"></i>Order Code
                    </div>
                    <div class="col">
                        {{ $orderList[0]->order_code }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <i class="fa-regular fa-clock mr-1"></i>Order Date
                    </div>
                    <div class="col">{{ $orderList[0]->created_at->format('M-d-Y') }}</div>
                </div>
                <div class="row">
                    <div class="col"><i class="fa-regular fa-money-bill-1 mr-1"></i>Total</div>
                    <div class="col">{{ $order->total_price }} kyats</div>
                </div>
            </div>
        </div>

        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2 text-center">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Order Date</th>
                        <th>Qty</th>
                        <th>Ammount</th>
                    </tr>
                </thead>
                <tbody id="dataList">
                    @foreach($orderList as $ol)
                        <tr class="tr-shadow">
                            <td style="padding-top: 40px;">{{ $ol->id }}</td>
                            <td style="width:50px;"><img src="{{ asset('storage/'.$ol->product_image) }}" alt="Prodcut Image" class="img-thumbnail shadow-sm"></td>
                            <td>{{ $ol->product_name }}</td>
                            <td>{{ $ol->created_at->format('M-j-Y') }}</td>
                            <td>{{ $ol->qty }}</td>
                            <td>{{ $ol->total }}</td>
                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>

    </div>
</div>
</div>
</div>
</div>
@endsection
