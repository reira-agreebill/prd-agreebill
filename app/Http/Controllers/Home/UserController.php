<?php

namespace App\Http\Controllers\Home;

use App\Application;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(){
       $account_info = Application::all()->first();
       $custom_css = Setting::find(18);
       return view('Home.show_store',[
           'account_info' =>$account_info,
           'custom_css'=>$custom_css,
       ]);
   }
}
