<?php

namespace App\Http\Controllers;

use App\Application;
use App\Category;
use App\Models\Addon;
use App\Models\AddonCategory;
use App\Models\AddonCategoryItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\SelectedSubscription;
use App\Models\Setting;
use App\Models\StoreSlider;
use App\Models\StoreSubscription;
use App\Models\Table;
use App\Models\UserExpense;
use App\Models\WaiterCall;
use App\Product;
use App\StoreSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;

class RestaurantAdminPageController extends Controller
{
    public function __construct(Redirector $redirect)
    {
        $this->middleware('auth:store');


        if(Route::currentRouteName()!='store_admin.subscription_plans' && (Setting::find(23)->value ?? 0) == 1){
            $redirect->to(route('store_admin.subscription_plans'))
                ->with("MSG", "There is no valid subscription plan in your account please renew it :)")->with("TYPE", "danger")
               ->send();
        }

    }
    public function index()
    {

        $store_id = Auth::user()->id;
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $order_count = Order::all()->where('store_id','=', $store_id )->count();
        $call_waiter_count = WaiterCall::all()->where('store_id','=', $store_id )->count();
        $item_sold = DB::table('orders')->where('store_id','=', $store_id )
            ->select('*')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->where('orders.status','=',4)
            ->get()->sum('quantity');

        $earnings = Order::all()->where('status','=',4)->where('store_id','=', $store_id )->sum('total');
        $account_info = Application::all()->first();
        $orders = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->where('status','=',1);



        $notification = $this->notification();



        return view('restaurants.dashboard',[
            "order_count"=>$order_count,
            'call_waiter_count'=>$call_waiter_count,
            "item_sold"=>$item_sold,
            "earnings"=> $earnings,
            "account_info" =>  $account_info,
            'orders'=>$orders,
            'notification'=>$notification,
            'sanboxNumber'=>$sanboxNumber,
            'root_name' => 'Dashboard',
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }
    public function orderstatus(){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $orders = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->where('status','=',2);
        $neworder = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->where('status','=',1);
        $ready = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->where('status','=',5);
        return view('restaurants.orderstatus',[
            'orders'=>$orders,
            'neworder'=>$neworder,
            'ready'=>$ready,
            'root_name' => 'Order Status Screen',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);

    }

    public function orders(){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $transation = new TranslationService();
        $orders = Order::all()->SortByDesc('id')->where('store_id', auth()->id());
        $orders_count = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->count();
        return view('restaurants.orders',[
            'orders'=>$orders,
            'orders_count'=>$orders_count,
            'root_name' => 'Orders',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()

        ]);

    }


    public function order_delete(Request $request)
    {

        Order::destroy($request->id);

        return back()->with(Toastr::success('Order Deleted successfully ','Success'));

    }

    public function new_orders(){


        $orders = Order::all()->SortByDesc('id')->where('store_id', auth()->id());
        $orders_count = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->count();
        $response = array();
        foreach ( $orders as $data)
            $response[] = $data;

        return response()->json([
            "success" => true,
            "status" => "success",
            "payload" => [
                'orders' =>$response,
                'count' =>$orders_count
            ]
        ], 200);

    }
    public function new_waiter_calls(){


        $orders = WaiterCall::all()->where('store_id', auth()->id());
        $orders_count = WaiterCall::all()->SortByDesc('id')->where('store_id', auth()->id())->count();
        $response = array();
        foreach ( $orders as $data)
            $response[] = $data;

        return response()->json([
            "success" => true,
            "status" => "success",
            "payload" => [
                'waiter_calls' =>$response,
                'call_waiter_count' =>$orders_count
            ]
        ], 200);

    }
    public function view_order(Order $id){
        $transation = new TranslationService();
        $orderDetails =  Order::with('orderDetails.OrderDetailsExtraAddon')->where('id',$id->id)->get()->toArray();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
//        return OrderDetails::with('OrderDetailsExtraAddon')->get();
//        return $orderDetails;
        $account_info = Application::all()->first();
        return view('restaurants.view_order',[
            'order'=>$id,
            'orderDetails'=>$orderDetails,
            'account_info'=>$account_info,
            'root_name' => 'Orders',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);

    }
    public function categories(){
        $transation = new TranslationService();
        $category_count = Category::all()->where('store_id', auth()->id())->count();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;

        $category = Category::withCount('productinfos')->where('store_id', auth()->id())->get();
        return view('restaurants.category',[
            'title' => 'category',
            'root_name' => 'category',
            'root' => 'category',
            'category'=>$category,
            'category_count'=>$category_count,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);


    }
    public function addcategories(){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.addcategory',['root_name' => 'Category',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);

    }
    public function update_category(Category $id){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $transation = new TranslationService();
        return view('restaurants.editcategory',
            [
                'title' => 'update Category',
                'root_name' => 'Category',
                'root' => 'Category',
                'data' => $id,
                'sanboxNumber'=>$sanboxNumber,
                'languages'=>$transation->languages(),
                'selected_language' => $transation->selected_language()

            ]);
    }

    public function products(){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $products_count = Product::all()->where('store_id', auth()->id())->count();
        $products = Product::all()->SortByDesc('id')->where('store_id', auth()->id());
        $productsnonveg = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_veg', '=', 0);
        $productsveg = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_veg', '=', 1);
        $productsdisabled = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_active', '=', 0);
        return view('restaurants.products',[
            'products'=>$products,
            'products_count'=>$products_count,
            'root_name' => 'Products',
            'productsnonveg' => $productsnonveg,
            'productsveg' => $productsveg,
            'productsdisabled' => $productsdisabled,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()

        ]);
    }

    public function addproducts(){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $category = Category::all()->where('store_id', auth()->id());
        $addon_category = AddonCategory::all()->where('store_id', auth()->id());
        return view('restaurants.addproducts',[
            'category'=>$category,
            'addon_category'=>$addon_category,
            'root_name' => 'Products',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }

    public function update_products(Product $id){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $addon_category = AddonCategory::all()->where('store_id', auth()->id());
        $category = Category::all()->where('store_id', auth()->id());
        $addon_category_items = AddonCategoryItem::all()->where('product_id','=',$id->id);

        return view('restaurants.editproducts',
            [
                'title' => 'update Products',
                'root_name' => 'Products',
                'root' => 'Products',
                'data' => $id,
                'category'=>$category,
                'addon_category'=>$addon_category,
                'sanboxNumber'=>$sanboxNumber,
                'addon_category_items'=>$addon_category_items->first(),
                'languages'=>$transation->languages(),
                'selected_language' => $transation->selected_language()
            ]);
    }


    public function addon_categories(){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $addons_count = AddonCategory::all()->where('store_id', auth()->id())->count();
        $addons = AddonCategory::all()->SortByDesc('id')->where('store_id', auth()->id());
        return view('restaurants.addons.addon_categories',[
            'addons'=>$addons,
            'addons_count'=>$addons_count,
            'root_name' => 'Addon Category',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }

    public function addon_categories_edit(AddonCategory $id){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $transation = new TranslationService();
        return view('restaurants.addons.edit_addon_categories',
            [
                'title' => 'update Category',
                'root_name' => 'Category',
                'root' => 'Category',
                'data' => $id,
                'root_name' => 'Addon Category',
                'sanboxNumber'=>$sanboxNumber,
                'languages'=>$transation->languages(),
                'selected_language' => $transation->selected_language()

            ]);
    }


    public function addon(){
        $transation = new TranslationService();
        $addons_category= AddonCategory::all()->where('store_id', auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $addon_count = Addon::all()->where('store_id', auth()->id())->count();
        $addon = Addon::all()->SortByDesc('id')->where('store_id', auth()->id());
        return view('restaurants.addons.addon',[
            'addon'=>$addon,
            'addon_count'=>$addon_count,
            'addons_category' => $addons_category,
            'root_name' => 'Addons',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }
    public function update_addon(Addon $id){
        $transation = new TranslationService();
        $addons_category= AddonCategory::all()->where('store_id', auth()->id());
        $addon_count = Addon::all()->where('store_id', auth()->id())->count();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;

        return view('restaurants.addons.update_addon',[
            'addon'=>$id,
            'addon_count'=>$addon_count,
            'addons_category' => $addons_category,
            'root_name' => 'Addons',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }


    public function tables(){
        $transation = new TranslationService();
        $tables = Table::all()->SortBy('table_name')->where('store_id', auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.tables.all_tables',[
            'title' => 'All Rooms',
            'tables'=>$tables,
            'root_name' => 'Room',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);

    }
    public function table_report(){
        $transation = new TranslationService();
        $tables = Table::all()->SortByDesc('id')->where('store_id', auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.tables.table_report',[
            'title' => 'All Rooms',
            'tables'=>$tables,
            'root_name' => 'Room Report',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }
    public function add_table(){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;


        return view('restaurants.tables.add_new_table',[
            'title' => 'Add New Room',
            'root_name' => 'Room',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }


    public function edit_table(Table $id){
        $transation = new TranslationService();
        $head_name="Update Table";
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.tables.edit_table',compact('id'),[
            'title' => 'Room',
            'root_name' => 'Room',
            'root' => 'Room',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }


    public function banner(){
        $transation = new TranslationService();
        $banner = StoreSlider::all()->SortByDesc('id')->where('store_id', auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.banner.banner',[
            'title' => 'All Rooms',
            'banner'=>$banner,
            'root_name' => 'Banners',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }

    public function banneredit(StoreSlider $id){
        $transation = new TranslationService();
        $head_name="Update Banner";
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.banner.edit_banner',compact('id'),[
            'title' => 'Banner',
            'root_name' => 'Banner',
            'root' => 'Banner',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }




    public function addbanner(){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.banner.addbanner',[
            'title' => 'Add Banner',
            'root_name' => 'Banners',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }

    public function subscription_plans(){
        $transation = new TranslationService();
        $publishableKey = Setting::all()->where('key','=','StripePublishableKey')->first()->value;
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $subscription = StoreSubscription::all()->where('is_active','=',1)->where('price','!=',0);
        $subscription_count = StoreSubscription::all()->where('is_active','=',1)->where('price','!=',0)->count();
        $isStripeEnabled =  Setting::all()->where('key','=','IsStripePaymentEnabled')->first()->value;

        $razorpay_key_id = Setting::all()->where('key','=','RazorpayKeyId')->first()->value;
        $razorpayEnabled =  Setting::all()->where('key','=','IsRazorpayPaymentEnabled')->first()->value;

        $paypalMode = Setting::all()->where('key','=','PaypalMode')->first()->value;
        $paypalKeyId =  Setting::all()->where('key','=','PaypalKeyId')->first()->value;
        $isPaypalEnabled = Setting::all()->where('key','=','IsPaypalPaymentEnabled')->first()->value;


        $currency = Setting::all()->where('key','=','Currency')->first()->value;
        $logo = Application::first()->application_logo;

        return view('restaurants.store_subscription.plans',[
            'title' => 'Subscription Plans',
            'subscription_count'=> $subscription_count,
            'subscription'=>$subscription,
            'publishableKey'=>$publishableKey,
            'isStripeEnabled'=> $isStripeEnabled,
            'root_name' => 'Subscription',
            'sanboxNumber'=>$sanboxNumber,
            'razorpayEnabled'=>  $razorpayEnabled,
            'razorpay_key_id'=>$razorpay_key_id,
            'currency'=>$currency,
            'logo'=>$logo,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language(),
            'paypalMode'=>$paypalMode,
            'paypalKeyId'=>$paypalKeyId,
            'isPaypalEnabled'=>$isPaypalEnabled

        ]);
    }
    public function subscription_history(){
        $transation = new TranslationService();
        $store_plan_history = SelectedSubscription::all()->where('store_id','=',\auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.store_subscription.history',[
            'store_plan_history' => $store_plan_history,
            'root_name' => 'Subscription History',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }

    public function settings(){
        $transation = new TranslationService();
        $store = Auth::user();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $store_settings = StoreSetting::all()->where('store_id',\auth()->id())->first();




        return view('restaurants.settings.index',[
            'title' => 'Settings',
            'store' =>$store,
            'root_name' => 'Settings',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language(),
            'store_settings'=>$store_settings

        ]);


    }

    public function notification(){
        $transation = new TranslationService();
        $notification = array();
        if(Auth::user()->subscription_end_date < date('Y-m-d')) {
            $notification['head'] = "YOUR SUBSCRIPTION HAS EXPIRED";
            $notification['sub_head'] = "Please renew your subscription to continue enjoying our services.";
            $notification['route_submit_button_name'] = "Renew Now";
            $notification['route'] = "store_admin.subscription_plans";
        }
        return $notification;
    }
    // customers
    public function customers(){
        $transation = new TranslationService();
        $customers = Order::all()->sortByDesc('id')->unique('customer_phone')->where('store_id','=',auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
//        return $customers[0]->total_orders(9544752154);
        return view('restaurants.customers.index',[
            'title' => 'Customers',
            'customers' => $customers,
            'root_name' => 'Customers',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }
    public function waiter_calls(){
        $transation = new TranslationService();
        $calls = WaiterCall::all()->where('store_id','=',auth()->id())->sortByDesc('id');
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;

//        return $customers[0]->total_orders(9544752154);
        return view('restaurants.waiterCall.view',[
            'title' => 'Customers',
            'count' => $calls->where('is_completed','=',0)->count(),
            'calls' => $calls,
            'root_name' => 'Waiter Call',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }


    public function store_expense(){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $expense = UserExpense::all()->where('store_id','=',auth()->id())->sortByDesc('id');
        return view('restaurants.expense.all_expense',[
            'title' => 'Expense',
            'root_name' => 'Expense',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language(),
            'expense' => $expense,

        ]);
    }


    public function coupons(){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $coupons = Coupon::all()->where('store_id','=',auth()->id())->sortByDesc('id');
        return view('restaurants.coupons.all_coupons',[
            'title' => 'Coupons',
            'root_name' => 'Coupons',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language(),
            'coupons' => $coupons,

        ]);
    }


    public function add_coupons(){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.coupons.add_coupons',[
            'title' => 'Coupons',
            'root_name' => 'Coupons',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language(),

        ]);
    }

}
