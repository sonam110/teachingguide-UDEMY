<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;

class PublicController extends Controller
{
    public function index(Request $request)
    {

      $landing = 'h'; //h - home for default
      if ($request->input('lp')) {
          $landing = $request->input('lp');
      }

      return view(
        'home_small',
        array(
          'title' => 'Udemy Course Instructor Insights - Online Course Research Made Easy',
          'meta' => 'Udemy Instructor Research is easy. Online Course Creation, Competitive Data, Ranking Optimization all in the Teachinguide Tool.',
          'landing' => $landing
        )
      );
    }

    public function product(Request $request)
    {
        $landing = 'p'; //h - home for default
        if ($request->input('lp')) {
            $landing = $request->input('lp');
        }
        return view(
          'product',
          array(
            'title' => 'The Udemy Course Instructor Research App',
            'meta' => 'Build a scalable Udemy business with one powerful solution. Find niche topics, track courses for future sales, and get access to accurate sales data and competitor data with the Teachinguide Web App!',
            'landing' => $landing
          )
        );
    }

    public function courseDatabase(Request $request)
    {
        $landing = 'cD'; //h - home for default
        if ($request->input('lp')) {
            $landing = $request->input('lp');
        }
        return view(
          'courseDatabase',
          array(
            'title' => 'The Udemy Course Instructor Research Tool',
            'meta' => 'Build a scalable Udemy business with one powerful solution. Find niche topics, track courses for future sales, and get access to accurate sales data and competitor data with the Teachinguide Web App!',
            'landing' => $landing
          )
        );
    }
    public function about(Request $request)
    {
        $landing = 'about'; //h - home for default
        if ($request->input('lp')) {
            $landing = $request->input('lp');
        }
        return view(
          'about',
          array(
            'title' => 'The Udemy Course Instructor Research Tool',
            'meta' => 'Build a scalable Udemy business with one powerful solution. Find niche topics, track courses for future sales, and get access to accurate sales data and competitor data with the Teachinguide Web App!',
            'landing' => $landing
          )
        );
    }
    public function affiliate(Request $request)
    {
        $url = 'https://teachinguide.firstpromoter.com/';
        return Redirect::to($url);
    }
    public function estimator(Request $request)
    {
        $landing = 'estimator'; //h - home for default
        if ($request->input('lp')) {
            $landing = $request->input('lp');
        }
        return view(
          'estimator',
          array(
            'title' => 'The Udemy Course Instructor Research Tool',
            'meta' => 'Build a scalable Udemy business with one powerful solution. Find niche topics, track courses for future sales, and get access to accurate sales data and competitor data with the Teachinguide Web App!',
            'landing' => $landing
          )
        );
    }
    public function freecourses(Request $request)
    {
      $landing = 'freecourses'; //h - home for default
      if ($request->input('lp')) {
      $landing = $request->input('lp');
      }
      return view(
      'freecourses',
      array(
      'title' => 'The Udemy Course Instructor Research Tool',
      'meta' => 'Build a scalable Udemy business with one powerful solution. Find niche topics, track courses for future sales, and get access to accurate sales data and competitor data with the Teachinguide Web App!',
      'landing' => $landing
      )
      );
    }

    public function offer()
    {
      return view(
          'offer',
          array(
            'title' => 'Udemy Course Instructor Newsletter Signup',
            'meta' => 'Get the latest news and insights for Udemy Instructors with our weekly newsletter.'
          )
      );
    }

    public function termsofuse()
    {
      return view('termsofuse');
    }

    public function privacyandpolicy()
    {
      return view('privacyandpolicy');
    }

    public function mailconfirmation()
    {
      $user = Auth::user();
      return view('mails.confirmation', compact('user', $user));
    }
}
