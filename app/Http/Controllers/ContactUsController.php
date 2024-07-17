<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
use App\Mail\ContactMessage;

class ContactUsController extends Controller
{
  public function contactUS(Request $request)
  {
    return view('contactUS');
  }

  public function contactUSPost(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'message' => 'required'
    ]);
    //send email to hello@teachinguide.com
    //notify myself
    $msg = new ContactMessage(
                  $request->message,
                  $request->email,
                  $request->name
                );

    //dd($msg);
    //Mail::to('hello@teachinguide.com')->send($msg);
    $name = $request->name;
    $email = $request->email;
    $msg = $request->message;

    $data = array('name'=>$name, 'email'=>$email, 'msg'=>$msg);
    Mail::send('mails.contact', $data, function($message) use ($email, $name)
    {
        $message->from($email, $name);
        $message->to('hello@teachinguide.com', 'Tom')->subject('Mail via teachinguide.com');
    });

    return back()->with('success', 'Thanks for contacting us!');
  }
}
