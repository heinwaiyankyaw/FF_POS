<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //admin session
    public function contactList(){
        $contacts = Contact::get();
        // dd($contacts->toArray());
        return view('admin.contact.list',compact('contacts'));
    }

    //user session
    public function contactCreatePage()
    {
        return view('user.contact.message');
    }

    public function contactCreate(Request $request)
    {
        $this->contactValidationCheck($request);
        $data = $this->getContactData($request);
        Contact::create($data);
        return back()->with(['messageSuccess' => "Your Contact message was sent."]);
    }

    public function contactDelete($id){
        Contact::where('id',$id)->delete();
        return back();
    }
    // private session
    private function contactValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:2',
        ])->validate();
    }

    private function getContactData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }
}
