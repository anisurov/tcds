<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Messages\MailMessage;
use Session;
use Storage;
use App\User;
use App\Teacher;
class registrationController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }


    public function index(){
      $this->verifyPermission(Auth::user()->check);
      return view('t_reg');
    }

 protected  function verifyPermission($checker){
      if($checker!=0){
        redirect('/');
      }
   }
    
    public function teacherRegs(Request $request){
      $this->validator($request->all());

              if ($request->hasFile('image')){
                         // $destinationPath=public_path('images\notice');
                          $file     = request()->file('image');
                          $fileName = 'tcds_img_'.date('_j\_m_Y_').rand(1,15).'_'. $file->getClientOriginalName();
                          Storage::put($fileName,$file);
              }else{
              $fileName='';
              }
      if($this->create($request->all(),$fileName)){
        $this->notifyThroughmail($request->t_email,$request->password);
       Session::flash('status', "Registration was successful!!");
        return redirect('profile');
      }else{
       Session::flash('failed', "Registration was failed!!");
        return redirect('profile');
      }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'joingDate'=> 'required|date',
            'image'=>'nullable|mimes:jpeg,bmp,png',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *  Create Teacher profile
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data,$image)
    {	
		 
		
		$resTeacherCR=Teacher::create([
		't_name'=>$data['t_name'],
		't_email'=>$data['t_email'],
		't_image'=>$image,
		't_designation'=>$data['t_designation'],
    'joining_date'=>date("Y-m-d", strtotime($data['joingDate'])),
    ]);
    
    $resUserCR=User::create([
            'name' => $data['t_name'],
            'email' => $data['t_email'],
            'password' => bcrypt($data['password']),
            'chk' =>0,
          ]);
    if($resTeacherCR&&$resUserCR){
    return true;
    }
    }
    public function notifyThroughmail($username,$password)
    {
       $introLines[0]='Your registration on was successful.<br>';
       $introLines[1]='Here is your credintials<br>';
       $introLines[2]='<b>Username/Email:</b>'.$username.'<br>';
       $introLines[3] = '<b>Password:</b>'.$password.'<br>';
        $actionText='login';
        $actionUrl=config('app.url').'/login';
        $title = $username;
        $content = $password;
       // $attach = $request->file('file');
	/*
	['introLines'=>$introLines,'actionText'=>$actionText,
          'level'=>'success','actionUrl'=>$actionUrl] 	
	*/
        Mail::send('emails.send',['title'=>$title,'content'=>$content],function ($message) use ($username)
        {

          $message->from('no-reply@tcdsystem.com', 'Administrator');

            $message->to($username);

           // $message->attach($attach);

            $message->subject("Course Distribution System Credintials");

        });


    }
}
