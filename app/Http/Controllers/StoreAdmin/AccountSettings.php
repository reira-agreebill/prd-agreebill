<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\StoreSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;

class AccountSettings extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:store');
    }
    public function update_store_settings(Request $request){

        $data = request()->validate([
            'store_name'=>'required',
            'email'=>'',
            'password'=>'',
            'phone'=>'required',
            'logo_url'=>'',
            'address'=>'',
            'currency_symbol'=>'',
            'service_charge'=>'',
            'tax'=>'',
            'description'=>'',

        ]);
        $data['table_enable'] = isset($request['table_enable']) ? 1:0;
        $data['is_accept_order'] = isset($request['is_accept_order']) ? 1:0;
        $data['search_enable'] = isset($request['search_enable']) ? 1:0;
        $data['language_enable'] = isset($request['language_enable']) ? 1:0;
        $data['whatsappbutton_enable'] = isset($request['whatsappbutton_enable']) ? 1:0;
        $data['dining_enable'] = isset($request['dining_enable']) ? 1:0;
        $data['delivery_enable'] = isset($request['delivery_enable']) ? 1:0;
        $data['takeaway_enable'] = isset($request['takeaway_enable']) ? 1:0;
        $data['takeaway_enable'] = isset($request['takeaway_enable']) ? 1:0;
        $data['is_call_waiter_enable'] = isset($request['is_call_waiter_enable']) ? 1:0;
        $data['is_room_delivery_enable'] = isset($request['is_room_delivery_enable']) ? 1:0;
        $data['is_room_delivery_dob_enable'] = isset($request['is_room_delivery_dob_enable']) ? 1:0;
        if ($request->logo_url != NULL) {
            Storage::delete(str_replace("storage","public",Store::find(auth()->id())->logo_url));
            $url = $request->file("logo_url")->store('public/stores/logo');
            $data['logo_url'] = str_replace("public","storage",$url);
        }
        if($request->password == NULL)
            unset($data['password']);
        else
            $data['password'] = Hash::make($request['password']);

        if(Store::whereId(auth()->id())->update($data)) {
            return back()->with(Toastr::success('Settings Updated Successfully.','Success'));
        }
    }
    public function update_payment_settings(Request $request){

        $data = request()->validate([
            'StoreCurrency'=>'required',
            'StripePublishableKey'=>'',
            'StripeSecretKey'=>'',
            'RazorpayKeyId'=>'',
            'RazorpayKeySecret'=>'',
            'PaypalMode'=>'',
            'PaypalKeyId'=>'',
            'PaypalKeySecret'=>'',
            'PayStackPublishableKey'=>'',
            'PayStackSecretKey'=>'',
            'MercadoPagoKeySecret'=>'',
            'store_id'=>''
        ]);
        $data['store_id'] = auth()->id();
        $data['IsCodEnabled'] = isset($request['IsCodEnabled']) ? 1:0;
        $data['IsQREnabled'] = isset($request['IsQREnabled']) ? 1:0;
        $data['IsPaypalEnabled'] = isset($request['IsPaypalEnabled']) ? 1:0;
        $data['IsStripeEnabled'] = isset($request['IsStripeEnabled']) ? 1:0;
        $data['IsRazorpayEnabled'] = isset($request['IsRazorpayEnabled']) ? 1:0;
        $data['IsPayStackEnabled'] = isset($request['IsPayStackEnabled']) ? 1:0;
        $data['IsStripeZipEnabled'] = isset($request['IsStripeZipEnabled']) ? 1:0;
        $data['IsMercadoPagoEnabled'] = isset($request['IsMercadoPagoEnabled']) ? 1:0;

        $data['store_id'] = auth()->id();

        if(StoreSetting::all()->where('store_id',"=",auth()->id())->isEmpty() == true ) {

           StoreSetting::create($data);

        }
        else{
            $id = StoreSetting::all()->where('store_id',"=",auth()->id())->first()->id;
            StoreSetting::whereId($id)->update($data);


        }

        return back()->with(Toastr::success('Payment Settings successfully updated', 'Success'));
    }
}
