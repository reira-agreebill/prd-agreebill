<?php

namespace App\Http\Controllers\WEBAPI;

use App\Application;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\TranslationService;
use App\Models\Addon;
use App\Models\AddonCategory;
use App\Models\AddonCategoryItem;
use App\Models\Order;
use App\Models\Store;
use App\Models\StoreSlider;
use App\Models\Table;
use App\Models\WaiterCall;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function fetch(Request $request)
    {
        $view_id = $request->view_id;
        if (Store::all()->where('view_id', '=', $view_id)->count() == 0) {
            return response()->json([
                "success" => false,
                "status" => "error",
                "error" => ["code" => 401,
                    "type" => "data not found (ERROR:RT404)",
                    "message" => "We are unable to process your request at this time. Please try again later"
                ],
            ], 401);
        }
        if (Store::all()->where('view_id', '=', $view_id)->where('is_visible', '=', 1)->count() == 0)
            return view('Home.404');
        $store = Store::all()->where('view_id', '=', $view_id)->first();
        $store_id = $store['id'];
        $store_name = $store['store_name'];
        $is_accept_order = $store['is_accept_order'];
        $description = $store['description'];
        $phone = $store['phone'];
        $sliders_data = StoreSlider::all()->where('is_visible', '=', 1)->where('store_id', '=', $store_id);
        $table_data = Table::all()->where('is_active', '=', 1)->where('store_id', '=', $store_id);
        $tables = [];
        $sliders = [];
        foreach ($table_data as $value)
            $tables[] = $value;
        foreach ($sliders_data as $value)
            $sliders[] = $value;
        $recommended_data = Product::with(['addonItems.categories.addons'])->where('store_id', '=', $store_id)
            ->where('is_recommended', '=', 1)
            ->where('is_active', '=', 1)->orderBy('name')->get();
        $recommended = [];
        foreach ($recommended_data as $value)
            $recommended[] = $value;
        $categories_data = Category::with('productInfo.addonItems.categories.addons')->where('store_id', '=', $store_id)->get()
            ->where('is_active', '=', 1)->sortBy('name');
        $categories = [];
        foreach ($categories_data as $value)
            $categories[] = $value;
        $products_data = Product::with(['addonItems.categories.addons'])->where('store_id', '=', $store_id)
            ->where('is_active', '=', 1)->orderBy('name')->get();
        $products = [];
        foreach ($products_data as $value)
            $products[] = $value;
        if ($store['currency_symbol'] != NULL) {
            $account_info = Application::all()->first();
            $account_info['currency_symbol'] = $store['currency_symbol'];
        } else
            $account_info = Application::all()->first();
        $Addon_product = Addon::all()->where('store_id', '=', $store_id);
        $addons = [];
        foreach ($Addon_product as $value)
            $addons[] = $value;
        $account_info['time_zone'] = env('APP_TIMEZONE', 'UTC');
        return response()->json([
            "success" => true,
            "status" => "success",
            "payload" => [
                'data' => [
                    'recommended' => $recommended,
                    'categories' => $categories,
                    'products' => $products,
                    'account_info' => $account_info,
                    'store_name' => $store_name,
                    'store_phone' => str_replace(" ", "", $phone),
                    'address' => $store['address'],
                    'logo' => $store['logo_url'],
                    'description' => $description,
                    'sliders' => $sliders,
                    'tables' => $tables,
                    'is_accept_order' => $is_accept_order,
                    'is_table_enable' => $store['table_enable'] ?? 1,
                    'is_search_enable' => $store['search_enable'] ?? 1,
                    'is_language_enable' => $store['language_enable'] ?? 1,
                    'is_whatsappbutton_enable' => $store['whatsappbutton_enable'] ?? 1,

                    'is_dining_enable' => $store['dining_enable'] ?? 1,
                    'is_delivery_enable' => $store['delivery_enable'] ?? 1,
                    'is_takeaway_enable' => $store['takeaway_enable'] ?? 1,

                    'is_room_delivery_enable' =>  $store['is_room_delivery_enable'] ?? 1,
                    'is_room_delivery_dob_enable' =>  $store['is_room_delivery_dob_enable'] ?? 1,

                    'is_call_waiter_enable' => $store['is_call_waiter_enable'] ?? 1, // add


                    'service_charge' => $store['service_charge'],
                    'tax' => $store['tax'],
                    'addons' => $addons,
                    'payment_gateways' => $store->getSettings
                ],
            ]
        ], 200);
    }

    public function calling_waiter(Request $request)
    {
        $title = "Waiter Call";
        $notification = new NotificationController();
        $data = $request->all();
        if ($request->order_id) {
            $order = Order::all()->find($request->order_id);
            $body = $order['table_no'] != NULL ? "Table #{$order['table_no']}{$order['customer_name']}({$order['order_unique_id']}) calling the waiter"
                : "#{$order['table_no']}{$order['customer_name']}({$order['order_unique_id']}) calling the waiter";
            try {
                $notification->send_notification($title, $body, $order['store_id']);
            } catch (\Exception $e) {

            }
            $data['customer_name'] = $order['customer_name'];
            $data['customer_phone'] = $order['customer_phone'];
            $data['table_name'] = $order['table_no'];
            $data['comment'] = "";
            $data['store_id'] = $order['store_id'];
            WaiterCall::create($data);
        } else {
            $data['store_id'] = Store::all()->where('view_id', '=', $request->store_id)->first()['id'];
            $body = $request['table_name'] != NULL ? "Table #{$request['table_name']} ({$request['customer_name']}) calling the waiter"
                : "{$request['table_name']}{$request['customer_name']} calling the waiter";
            try {
                $notification->send_notification($title, $body, $data['store_id']);
            } catch (\Exception $e) {

            }
            WaiterCall::create($data);
        }
        return response()->json([
            "success" => true,
            "status" => "success",
            "payload" => [
                'data' => []

            ]
        ], 200);

    }

    public function all_translation(Request $request)
    {
        $translation = new TranslationService();
        $response = array();
        $translation_data = $translation->languages();

        foreach ($translation_data as $data)
            $response[] = $data;
        return response()->json([
            "success" => true,
            "status" => "success",
            "payload" => [
                'data' => $response
            ]
        ], 200);
    }

    public function translation(Request $request)
    {
        $translation = new TranslationService();
        $response = array();
        $translation_data = $translation->selected_language_api($request->language_id);
        return response()->json([
            "success" => true,
            "status" => "success",
            "payload" => [
                'data' => $translation_data
            ]
        ], 200);
    }
    public function verify_coupon(Request $request){
        $store = Store::getStoreByViewId($request->view_id);
        $coupons = $store->getCoupons;
        $coupon = $coupons->where('is_active','=',1)->where('code','=',$request->coupon_code)->first();
        $response = [];
        if($coupon){
            $response['success'] = true;
            $response['status'] = "COUPON-200";
            $response['payload'] = $coupon;
            $response['message'] = "Valid Coupon!!!";
        }else {
            $response['success'] = false;
            $response['status'] = "COUPON-400";
            $response['payload'] = $coupon;
            $response['message'] = "Invalid Coupon!!!";
        }

        return response()->json([
            "success" => $response['success'],
            "status" => $response['status'],
            "payload" => $response['payload'],
            "message" => $response['message']
        ], 200);
    }
}
