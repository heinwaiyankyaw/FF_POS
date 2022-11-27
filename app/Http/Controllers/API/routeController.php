<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class routeController extends Controller
{
    public function products()
    {
        $products = Product::get();
        $data = [
            'product' => $products,
        ];
        return response()->json($data, 200);
    }

    public function categories()
    {
        $categories = Category::get();
        $data = [
            'category' => $categories,
        ];
        return response()->json($data, 200);
    }

    public function users()
    {
        $admin = User::where('role', 'admin')->get();
        $user = User::where('role', 'user')->get();
        $data = [
            'admin' => $admin,
            'user' => $user,
        ];
        return response()->json($data, 200);
    }

    public function ordersList(){
        $order = Order::get();
        $data = [
            'orders' => $order
        ];
        return response()->json($data,200);
    }
}
