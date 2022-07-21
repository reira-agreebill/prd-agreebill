<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;

class ModuleController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }

    public function install_modules(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => '',
            'version' => '',
            'category' => '',
            'module_id' => 'required',
            'is_active' => '',
            'is_installed' => '',
            'is_paid' => '',
        ]);

        if (Module::create($data))
            return Redirect::route( "all_modules" )->with(Toastr::success('Table Added successfully ','Success'));
    }


}
