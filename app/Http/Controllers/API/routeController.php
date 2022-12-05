<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
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
        $categories = Category::orderBy('created_at','desc')->get();
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

    public function createCategory(Request $request){
       $data = [
         'name' => $request->name,
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now(),
       ];
       $response = Category::create($data);
        return response()->json($response,201);
    }

    public function createContact(Request $request){
       $data = $this->getContactData($request);
       Contact::create($data);
       $contact = Contact::orderBy('created_at','desc')->get();
       return response()->json($contact,200);
    }

    public function deleteCategory(Request $request){
        $getData = Category::where('id',$request->category_id)->first();
        $deleteSuccess = ["status" => true, "message" => "Delete Success"];
        $deleteFail = ["status" => false, "message" => "Failed to Delete. No Data Found."];
        if(isset($getData)){
            Category::where('id',$request->category_id)->delete();
            return response()->json($deleteSuccess,200);
        }else{
            return response()->json($deleteFail,200);
        }

    }

    public function categoryDetails($id){
        // $id = $request->category_id;
        $errorMsg =[
            "stats" => false,
            "message" => "Not Match Data in Our Database."
        ];
        $data = Category::where('id',$id)->first();
        if (isset($data)) {
            return response()->json($data,200);
        }else{
            return response()->json($errorMsg,500);
        }
    }

    public function categoryUpdate(Request $request){
        $id = $request->category_id;
        $data = $this->getCategoryData($request);
        Category::where('id',$id)->update($data);
        $message = [
            'message' => 'Update Category was Successed.'
        ];
        return response()->json($message,200);
        // return response()->json($message, 200, $headers);
    }

    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    private function getCategoryData($request){
        return [
            'name' => $request->name,
            'updated_at'=> Carbon::now()
        ];
    }
}
