<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        $pizzas = Product::orderBy('created_at', 'desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home', compact('pizzas', 'categories','cart','orders'));
    }

    public function userList()
    {
        $users = User::where('role','user')->paginate('4');
        return view('admin.user.list',compact('users'));
    }

    public function changeUserRole(Request $request){
        logger($request->all());
        User::where('id',$request->userId)->update(['role' => $request->status]);
    }
    //change password page
    public function changePasswordPage()
    {
        return view('user.account.changePassword');
    }
    //change password
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);
        $currentId = Auth::user()->id;
        $user = User::select('password')->where('id', $currentId)->first();
        $dbHashValue = $user->password;
        // dd($dbHashValue);

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->confirmPassword),
            ];
            User::where('id', Auth::user()->id)->update($data);

            return back()->with(['changeSuccess' => 'Password was Changed...']);
        }
        return back()->with(['notMatch' => 'Something was wrong..']);

    }

    public function accountChangePage()
    {
        return view('user.account.profile');
    }

    //update data account
    public function accoutUpdate($id, Request $request)
    {
        $this->userValidationCheck($request);
        $data = $this->getUserData($request);
        if ($request->hasFile('image')) {
            $dbimage = User::where('id', $id)->first();
            $dbimage = $dbimage->image;
            if ($dbimage != null) {
                Storage::delete('public/' . $dbimage);
            }
            $fileName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Profile was updated.']);

    }

    //filter pizza
    public function filter($categoryId)
    {
        $pizzas = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $categories= Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','categories','cart','orders'));
    }

    //pizza info
    public function pizzaDetails($pizzaId)
    {
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaLists = Product::get();
        return view('user.main.details',compact('pizza','pizzaLists'));
    }

    // cart list
    public function cartList(){
        $cartLists = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('user_id',Auth::user()->id)->get();
        // dd($cartLists->toArray());
        $totalPrice = 0;
        foreach ($cartLists as $cartList) {
            $totalPrice += $cartList->pizza_price*$cartList->qty;
        }
        // dd($totalPrice);
        return view('user.main.cart',compact('cartLists','totalPrice'));
    }

    //history page
    public function history(){
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('4');
        return view('user.main.history',compact('orders'));
    }

    //private function session
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }

    private function userValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg,svg,gif|file|image',
        ])->validate();
    }

    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'updated_at' => Carbon::now(),
        ];
    }
}
