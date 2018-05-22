<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Teacher;
use App\PUNotify;
use Session;

class teacherController extends Controller
{
    public function all()
    {
      $data = Teacher::paginate(10);
      return view('admin.teacher.all',compact('data'));
    }

    public function individual(Request $request)
    {
      $teacher_id = $request->teacher_id;
      $teacher = Teacher::where('t_id',$teacher_id)->get();
      return view('admin.teacher.setting',compact('teacher'));
    }

    public function showProfileEditForm(Request $request){
              $type = $request->type;
              $email = $request->email;
              $teacher = $this->getData($email);
         	   return view('admin.teacher.setting',compact('teacher','type'));

    }


    public function updateProfile(Request $request){

   		$this->validateData($request->all());
      $email =$request->email;
   	foreach($request->all() as $key=>$value){
      if ($key!='email') {
        $index= $key;
        $inf= $value;
      }
    }
   			if($this->updateData($index,$inf,$email)){
          $notify = new PUNotify();
          $notify->t_id = Teacher::where('t_email',$email)->pluck('t_id')->first();
          $notify->message = "Your profile has updated by admin";
          $notify->status=1;
          $notify->save();
          $title = "Course Distribution System - Profile info updated";
          Mail::send('emails.notify_update',['title'=>$title],function ($message) use ($email)
          {

            $message->from('no-reply@tcdsystem.com', 'Administrator');

              $message->to($email);

             // $message->attach($attach);

              $message->subject("Course Distribution System - Profile info updated");

          });
   			return redirect(route('teacherlist'))->withSuccess('Your profile updated successfully');
      }
   			else
        return redirect(route('teacherlist'))->withFailed('profile update failed');
  }

    protected function getData($email){
      //  $email = Auth::user()->email;
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
