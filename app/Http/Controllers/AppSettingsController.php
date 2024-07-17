<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webapp_user_setting;
use DB;
use Carbon\Carbon;
use Auth;

class AppSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getConfigs(Request $request) {

      $user_id = Auth::User()->id;
      $match = ['user_id' => $user_id];

      if ($request->input("r")) {
          $report_id = $request->input("r");
          $match += ['report_id' => $report_id];
      }
      if ($request->input("o")) {
          $object_id = $request->input("o");
          $match += ['object_id' => $object_id];
      }

      $settings = Webapp_user_setting::where($match)->get();

      if (empty($settings)) {
          return \Response::json([]);
      }
      $data = array();

      if($settings){
          foreach($settings as $r){
              $nestedData['id'] = $r->config_id;
              $nestedData['name'] = $r->config_name;
              $nestedData['config'] = $r->config;
              $data[] = $nestedData;
          }
      }

      $json_data = array(
          "draw"              => intval($request->input('draw')),
          "data"              => $data
      );

      return \Response::json($data);
    }

    public function getConfig(Request $request) {

      $user_id = Auth::User()->id;
      $match = ['user_id' => $user_id];

      if (!$request->input("id")) {
          return \Response::json([]);
      }
      $config_id = $request->input("id");
      $match += ['config_id' => $config_id];

      $setting = Webapp_user_setting::where($match)->first();

      if (empty($setting)) {
          return \Response::json([]);
      }
      $formatted = [
        'id' => $setting->config_id,
        'name' => $setting->config_name,
        'config' => $setting->config
      ];

      return \Response::json($formatted);

    }
}
