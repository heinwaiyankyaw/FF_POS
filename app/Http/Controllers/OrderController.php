<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // direct order list page
    public function list(){
        $orders = Order::select('orders.*','users.name as user_name')
                  ->leftJoin('users','users.id','orders.user_id')
                  ->when(request('key'),function($query){
                    $query->orWhere('users.name','like','%'.request('key').'%')->orWhere('order_code','like','%'.request('key').'%');
                  })
                  ->orderBy('created_at','desc')
                  ->get();
        // dd($orders->toArray());
        return view('admin.order.list',compact('orders'));
    }

    // sorting ajax status
    public function changeStatus(Request $request){

        // $request->status = $request->status == null ? "" : $request->status;
        // where('orders.status',$request->status)
        $orders = Order::select('orders.*','users.name as user_name')
                  ->leftJoin('users','users.id','orders.user_id')
                  ->orderBy('created_at','desc');

        if ($request->orderStatus == null) {
           $orders =$orders->get();
        }else{
            $orders= $orders->where('orders.status',$request->orderStatus)->get();
        }

        return view('admin.order.list',compact('orders'));

    }

    // ajax change status
    public function ajaxChangeStatus(Request $request){
        Order::where('id',$request->orderId)->update(['status'=>$request->status]);
    }
}
