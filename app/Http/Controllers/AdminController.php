<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //direct change password page
    public function changePasswordPage()
    {
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request)
    {
        /*
        Step of Changing Password
        1.all field must be fill
        2.old,new & confirm password length must be greater than 6
        3.new & confirm password must be same
        4. user old password must be same with database user password
        5.password change
         */
        $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id', $currentUserId)->first();
        $dbHashValue = $user->password; //

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data = ['password' => Hash::make($request->newPassword)];
            User::where('id', $currentUserId)->update($data);
            return back()->with(['changeSuccess' => 'Password Changed...']);
        }
        return back()->with(['notMatch' => 'The old Password do not match. Try Again.']);

    }

    //admin details page
    public function details()
    {
        return view('admin.account.details');
    }

    // edit
    public function edit()
    {
        return view('admin.account.edit');
    }

    //update
    public function update($id, Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        // for image
        if ($request->hasFile('image')) {
            // 1.old image shi yin delete mal ma shi yin nothing to do. but store ya mal
            $dbimage = User::where('id', $id)->first();
            $dbimage = $dbimage->image;
            if ($dbimage != null) {
                Storage::delete(['public/' . $dbimage]);
            }
            $fileName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Account successfully update']);
    }

    //account list
    function list() {
        $admins = User::when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%')
                ->orWhere('phone', 'like', '%' . request('key') . '%');
        })
            ->where('role', 'admin')
            ->orderBy('id', 'desc')
            ->paginate(3);

        $admins->appends(request()->all());
        return view('admin.account.list', compact('admins'));
    }

    //acount delete
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Other Admin account was deleted.']);
    }

    //account role change direct
    public function changeRole($id)
    {
        $account = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('account'));
    }

    // role change
    public function change($id, Request $request)
    {
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    public function roleChange(Request $request){
        logger($request->all());
        User::where('id',$request->admin_id)->update(['role'=>$request->roleSatus]);
    }
    //private function session
    private function passwordValidationCheck($request) //password validation check
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',
        ])->validate();
    }

    //update account private function session
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

    //validation check
    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg,svg,gif|file|image',
        ])->validate();
    }

    private function requestUserData($request){
        return [
            'role' => $request->role,
        ];
    }

}
