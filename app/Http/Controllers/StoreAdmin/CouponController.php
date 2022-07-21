<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CouponController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:store');
    }

    public function create_coupons(Request $request)
    {
        $data = request()->validate([
            'name' => '',
            'description' => '',
            'code' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
        ]);

        $data['store_id'] = auth()->id();
        $data['is_active'] = isset($request['is_active']) ? 1:0;

        if (Coupon::create($data))
            return Redirect::route( "store_admin.coupons" )->with(Toastr::success('Coupons Added successfully ','Success'));
    }

    public function delete_coupons(Request $request)
    {

        Coupon::destroy($request->id);

        return back()->with(Toastr::success('Coupons Deleted successfully ','Success'));

    }


}
