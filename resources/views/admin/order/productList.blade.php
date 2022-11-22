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
                        <h3 class="mt-1"><i class="fa-solid fa-database"></i> 1</h3>
                    </div>

                    <div class="w-25">
                        <form action="#" method="get">
                            {{-- @csrf --}}
                            <div class="input-group">
                                <input type="text" name='key' class="form-control" placeholder="Search Here..." value="{{ request('key') }}">
                                <button type="submit" class="text-white btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

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
                    {{-- @foreach ($orders as $order)
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
                    @endforeach --}}
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                    </tr>
                </tbody>
            </table>

    </div>
</div>
</div>
</div>
</div>
@endsection
