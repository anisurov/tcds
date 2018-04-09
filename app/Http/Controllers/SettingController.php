<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Messages\MailMessage;
use Session;
use Storage;
use App\User;
use App\Teacher;


class SettingController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }


    public function index(){
      if($this->verifyPermission(Auth::user()->check)==false){
		//Session::flash('failed','You are not permitted to view this page');
		return redirect('/profile')->withFailed('You are not permitted to view this page');
	}else
           $teacher = $this->setData();
      	   return view('setting',compact('teacher'));
    }

 public function showProfileEditForm($request){
	if($this->verifyPermission(Auth::user()->check)==false){
		Session::flash('failed','You are not permitted to view this page');
		return redirect('/profile');
	}else
           $teacher = $this->setData();
      	   return view('setting',compact('teacher','request'));

 }


 public function updateProfile(Request $request){
	if($this->verifyPermission(Auth::user()->check)==false){
		Session::flash('failed','You are not permitted to view this page');
		return redirect('/profile');
	}

		$this->validateData($request->all());
	foreach($request->all() as $key=>$value){
			if($this->updateData($key,$value,Auth::user()->email))
			Session::flash('success','Your profile updated successfully');
			else
			Session::flash('failed','profile update failed');}
      	   return redirect('/setting');

 }


public function changePassword(Request $request)
{
  if($this->verifyPermission(Auth::user()->check)==false){
		Session::flash('failed','You are not permitted to view this page');
		return redirect('/profile');
	}
    $request_data = $request->All();
    $validator = $this->admin_credential_rules($request_data);
    if($validator->fails())
    {
      return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
    }
    else
    {
      $current_password = Auth::User()->password;
      if(Hash::check($request_data['current_password'], $current_password))
      {
        $user_id = Auth::User()->id;
        $obj_user = User::find($user_id);
        $obj_user->password = Hash::make($request_data['password']);;
        $obj_user->save();
        Session::flash('success','Your password changed successfully');
      }
      else
      {
        Session::flash('failed','password change failed');
      }
    }
	return redirect('/setting');
  }

  public function admin_credential_rules(array $data)
{
  $messages = [
    'current_password.required' => 'Please enter current password',
    'password.required' => 'Please enter password',
  ];

  $validator = Validator::make($data, [
    'current_password' => 'required',
    'password' => 'required|same:password',
    'password_confirmation' => 'required|same:password',
  ], $messages)->validate();

  return $validator;
}

 protected  function verifyPermission($checker){
      if($checker==0){
       return false;
      }
	return true;
   }
 protected function getData(){
     $email = Auth::user()->email;
    return Teacher::where('t_email',$email)->get();
 }
protected function updateData($key,$value,$email){
		switch($key){
			case 't_name':
				return Teacher::where('t_email',$email)->update(['t_name'=>$value]);
			break;
			case 't_contact':
				return Teacher::where('t_email',$email)->update(['t_contact'=>$value]);
			break;
			case 'joingDate':
				return Teacher::where('t_email',$email)->update(['joining_date'=>$value]);
			break;
			case 'promotionDate':
				return Teacher::where('t_email',$email)->update(['promotion_date'=>$value]);
			break;
			case 't_designation':
				return Teacher::where('t_email',$email)->update(['t_designation'=>$value]);
			break;
			case 'busy':
				return Teacher::where('t_email',$email)->update(['is_busy'=>$value]);
			break;
			default:
			return false;

		}
}
 protected function setData(){
	$value = $this->getData();
	return $value;
 }

 protected function validateData(array $data){
	foreach($data as $key=>$value){
		switch($key){
			case 't_name':
 			    return Validator::make($data, [
          		    't_name' => 'required|string|max:255',])->validate();

			break;

      case 't_contact':
 			    return Validator::make($data, [
          		    't_contact' => 'required|regex:/^[0][1][5-9][0-9][0-9](\d{6})$/|unique:teachers,t_contact',])->validate();

			break;

			case 'joingDate':
 			      return Validator::make($data, [
          			  'joingDate'=> 'required|date',])->validate();

			break;
			case 'promotionDate':
		             return Validator::make($data, ['promotionDate'=> 'required|date',])->validate();

			break;
			case 't_designation':
 		             return Validator::make($data, [
		            't_designation' => 'required|string|max:50',])->validate();
			break;

			case 'busy':
 		             return Validator::make($data, [
		            'busy' =>  array('required','regex:/yes|no$/'),])->validate();
			break;

			default:
			return false;

		}
	}

 }
}
