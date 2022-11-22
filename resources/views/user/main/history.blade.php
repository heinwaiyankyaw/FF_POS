@extends('user.layouts.master')
@section('title','Add to Cart')
@section('content')
        <!-- Cart Start -->
        <div class="container-fluid" style="height: 300px;">
            <div class="row px-xl-5">
                <div class="col-lg-8 offset-2 table-responsive mb-5">
                      <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Date</th>
                                <th>Order Code</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($orders as $order)
                            <tr>
                                <th>{{ $order->created_at->format('M-j-Y') }}</th>
                                <th>{{ $order->order_code }}</th>
                                <th>{{ $order->total_price }} kyats</th>
                                <th>
                                @if($order->status == 0)
                                    <span class="text-warning"><i class="fa-solid fa-clock me-2"></i>Pending</span>
                                @elseif ($order->status == 1)
                                    <span class="text-primary"><i class="fa-solid fa-check me-2"></i>Complete</span>
                                @else
                                    <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>Reject</span>
                                @endif</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
@endsection

