<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Redirect;
use Session;
use DB;

class Contacts extends Controller
{
    public function index(){
    	$data = [];
    	$data['title'] = "Contact list";
    	$data['items'] = Contact::paginate(5);

    	return view('welcome', $data);
    }

    public function Store(Request $request){

        $this->validate($request,[
            "name"        => "required",
            "email" => "required|email:rfc,dns|unique:contacts",
            "phone"       => "required|numeric|digits_between:11,13",
            "designation" => "required",
        ]);
        $data = array();
        $data['full_name']   = $request->name;
        $data['phone']       = $request->phone;
        $data['email']       = $request->email;
        $data['designation'] = $request->designation;

        $save = Contact::create($data);

        if($save){
            Session::flash("success_msg","Successfully Saved");
            return Redirect::to("/");
        }else{
            Session::flash("error_msg","Failed to Saved");
            return Redirect::to("/");
        }
        
    }

    public function Edit($id){
        $data = array();
        $data['title'] = 'Edit Contact';
        $data['contact'] = Contact::findOrFail($id);

        $data['items'] = Contact::paginate(5);
        return view('/welcome', $data);
    }

    public function Update(Request $request){

       $id = $request->contact_id;      

        $this->validate($request,[
            "name"  => "required",
            "email" => "required|email:rfc,dns|unique:contacts,email,".$id,
            "phone"       => "required|numeric|digits_between:11,13",
            "designation" => "required",
        ]);

        $data = array();
        $data['full_name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['designation'] = $request->designation;

        $save = Contact::where('id', $id)->update($data);
        if($save){
            Session::flash("success_msg","Successfully Updated");
            return Redirect::to('/');
        }else{
            Session::flash("error_msg","Failed to Update");
            return Redirect::to("/contact/edit/".$id);
        }
        
    }

    public function Delete($id){   

        $save = Contact::where('id', $id)->delete();
        if($save){
            Session::flash("success_msg","Successfully Deleted");
        }else{
            Session::flash("error_msg","Failed to Deleted");
        }

        return Redirect::to("/");
        
    }
}
