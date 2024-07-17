<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Mail;
use Notifiable;
use Validator;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;


class AffiliateController extends Controller
{
    public function __construct()
    {
      $this->middleware('checkRole:member');
    }

    public function affiliateId(){
      $user = Auth()->user();

      return $user->affiliate_id;

  	}
}
