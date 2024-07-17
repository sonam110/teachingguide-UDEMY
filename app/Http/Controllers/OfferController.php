<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Mail\AdminNote;
use App\Events\UserRegistered;

class OfferController extends Controller
{
  public function thankyou(Request $request)
  {
      $username = $request->name;

      return view('thankyouoffer', compact('username'));
  }

  public function getoffer(Request $request)
  {

      $validatedData = $request->validate([
          'name'     => 'required|string|max:255',
          'email'    => 'required|string|email|max:255',
      ]);

      $user = new User([
        'email' => $request->email,
        'first_name' => $request->name,
        'last_name' => '',
      ]);

      $admin_note = $user['email'] . ' - just downloaded an eBook.';
      Mail::to('thomas@seidel.info')->send(new adminnote($admin_note));

      event(new UserRegistered($user));

      return view('thankyouoffer', compact('user'));

  }
}
