<?php

namespace App\Http\Controllers;

use App\Application;
use App\Category;
use App\Expense;
use Lang;
use App\Homes;
use App\Models\Order;
use App\Models\SelectedSubscription;
use App\Models\Setting;
use App\Models\Store;
use App\Models\StoreSubscription;
use App\Module;
use App\Product;
use App\Slider;
use App\Testimonial;
use App\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use function GuzzleHttp\Promise\all;


class AdminPageController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(){
        $account_info = Application::all()->first();
        $store_count = Store::all()->count();
        $product_count = Product::all()->count();
        $earnings = SelectedSubscription::all()->where('payment_status','=','paid')->sum('subscription_price');
        $new_stores = Store::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $pending_stores = 0;

        $expired_stores = Store::all()->where('subscription_end_date','<',date('Y-m-d'));


        return view('admin.index',[
            'title' => '',
            'root_name' => 'Dashboard',
            'root' => 'dashboard',
            'account_info'=> $account_info,
            'store_count'=>$store_count,
            'product_count'=>$product_count,
            'pending_stores'=>$pending_stores,
            'earnings'=>$earnings,
            'new_stores'=>$new_stores,
            'expired_stores'=>$expired_stores
        ]);
    }
    public function add_store(){
        return view('admin.store.add_store',[
            'title' => '',
            'root_name' => 'Store',
            'root' => 'store',
        ]);
    }
    public function all_stores(){


        $stores = Store::all();

        return view('admin.store.all_stores',[
            'title' => 'Store',
            'root_name' => 'store',
            'root' => 'store',
            'stores'=>$stores
        ]);
    }

public function edit_stores(Store $id){

    $head_name="Update Employee";

    return view('admin.store.edit_store',compact('id'),
    [
        'title' => 'Store',
        'root_name' => 'Update Stores',
        'root' => 'store',
    ]);
}

    public function edit_store_url(Store $id){

        $head_name="Update Store Url";

        return view('admin.store.edit_store_url',compact('id'),
            [
                'title' => 'Store',
                'root_name' => 'Update Stores Url',
                'root' => 'store',
            ]);
    }
public function all_slider(){
    $sliders = Slider::all()->sortBy('id');
    return view('admin.slider.all_sliders',
        [
            'title' => 'Sliders',
            'root_name' => 'Sliders',
            'root' => 'sliders',
            'sliders'=>$sliders
        ]);
}
    public function add_slider(){

        return view('admin.slider.add_slider',
            [

                'title' => 'Sliders',
                'root_name' => 'Sliders',
                'root' => 'sliders',

            ]);
    }
    public function update_slider(Slider $id){
        return view('admin.slider.update_slider',
            [
                'title' => 'update Sliders',
                'root_name' => 'Sliders',
                'root' => 'sliders',
                'data' => $id

            ]);
    }

    public function settings(){
        $account_info = Application::all()->first();
        $modules = Module::all()->where('category', 1);
        return view('admin.settings.index',
            [
                'title' => 'Settings',
                'root_name' => 'Settings',
                'root' => 'settings',
                'account_info' =>$account_info,
                'modules' =>$modules
            ]);
    }



    public function paymentsettings(){
        $account_info = Application::all()->first();
//        $settings = DB::table('settings')->orderBy('id')->get();
        $settings = DB::table('settings')->orderBy('id')->get();
        return view('admin.settings.paymentsettings',
            [
                'title' => 'Payment Settings',
                'root_name' => 'Settings',
                'root' => 'settings',
                'account_info' =>$account_info,
                'settings'=>$settings
            ]);
    }
    public function account_settings(){
        return view('admin.settings.account_settings',
            [
                'root' => 'settings',
                'root_name' => 'Settings',
                'title' => 'Account settings',

            ]);
    }

    public function privacy_policy(){
        $privacy = Setting::all();
        return view('admin.settings.privacy_policy',
            [
                'root' => 'settings',
                'root_name' => 'Settings',
                'title' => 'Account settings',
                'privacy' => $privacy

            ]);
    }

    public function whatsapp(){
        $whatsapp = Setting::all();
        return view('admin.settings.whatsapp',
            [
                'root' => 'Whatsapp Notification',
                'root_name' => 'Whatsapp Notification',
                'title' => 'Whatsapp Notification',
                'whatsapp' => $whatsapp

            ]);
    }

    public function customcss(){
        $customcss = Setting::all();
        return view('admin.settings.custom_css',
            [
                'root' => 'Custom Css',
                'root_name' => 'Custom Css',
                'title' => 'Custom Css',
                'customcss' => $customcss

            ]);
    }


    public function cache_settings(){
        return view('admin.settings.cache_settings',
            [
                'root' => 'Cache',
                'root_name' => 'Cache',
                'title' => 'Cache',

            ]);
    }







    public function subscription(){
        $account_info = Application::all()->first();
        $subscription = StoreSubscription::all();

        return view('admin.subscription.all_subscription',[
            'title' => 'Subscription',
            'root_name' => 'Subscription',
            'root' => 'Subscription',
            'account_info' =>$account_info,
            'subscription'=>$subscription,

        ]);
    }

    public function addsubscription(){

        return view('admin.subscription.add_subscription',[
            'title' => 'Subscription',
            'root_name' => 'Subscription',
            'root' => 'Subscription',
        ]);
    }

    public function editsubscription(StoreSubscription $id){
        $head_name="Update Subscription";

        return view('admin.subscription.edit_subscription',compact('id'),[
            'title' => 'Subscription',
            'root_name' => 'Subscription',
            'root' => 'Subscription',
        ]);
    }


    public function tables(){

        return view('admin.tables.all_tables',[
            'title' => 'Tables',
            'root_name' => 'Tables',
            'root' => 'Tables',
        ]);
    }
    public function translations(){
        $data = Translation::all();
        return view('admin.translations.index',[
            'title' => 'Translations',
            'root_name' => 'Translations',
            'root' => 'translations',
            'data'=>$data
        ]);
    }
    public function add_translations(){
        $account_info = Application::all()->first();


        return view('admin.translations.add_translation',[
            'title' => 'Translation',
            'root_name' => 'Translation',
            'root' => 'translation',
            'account_info'=>$account_info
        ]);
    }
    public function update_translation(Translation $id){
        $account_info = Application::all()->first();
        return view('admin.translations.update_translation',[
            'title' => 'Translation',
            'root_name' => 'Translation',
            'root' => 'translation',
            'data'=>$id,
            'account_info'=>$account_info
        ]);
    }


    public function transactions(){
        $transactions = SelectedSubscription::all();
        return view('admin.transactions.all_transactions',[
            'title' => 'Transactions',
            'root_name' => 'Transactions',
            'root' => 'Transactions',
            'transactions'=>$transactions
        ]);
    }


    // customers
    public function customers(){
        $customers = Order::all()->sortByDesc('id')->unique('customer_phone');
        return view('admin.customers.index',[
            'title' => 'Customers',
            'customers' => $customers,
            'root' => 'Customers',
            'root_name' => 'Customers'
        ]);
    }

    // testimonials
    public function testimonials(){
        $testimonial = Testimonial::all()->sortByDesc('id');
        return view('admin.testimonials.index',[
            'title' => 'Testimonials',
            'testimonial' => $testimonial,
            'root' => 'Testimonials',
            'root_name' => 'Testimonials'
        ]);
    }

    public function all_modules(){


        $modules = Module::all()->where('is_installed','=',1);

        return view('admin.modules.all_modules',[
            'title' => 'Modules',
            'root_name' => 'Premium Modules',
            'root' => 'modules',
            'modules'=>$modules
        ]);
    }


    public function uploaded_modules(){

        $module1 = Module::where('module_id','=','TH1P')->get();
        $TH1P = File::get(base_path('Modules/TH1P.txt'));
        if ($TH1P && count($module1) == 0) {
            $TH1PMsg =  $TH1P;
        } else {
            $TH1PMsg = null;
        }


        $module2 = Module::where('module_id','=','M2PD')->get();
        $M2PD = File::get(base_path('Modules/M2PD.txt'));
        if ($M2PD && count($module2) == 0) {
            $M2PDMsg =  $M2PD;
        } else {
            $M2PDMsg = null;
        }



        return view('admin.modules.uploaded_modules',[
            'title' => 'Modules',
            'root_name' => 'Premium Modules',
            'root' => 'modules',
            'TH1PMsg' => $TH1PMsg,
            'M2PDMsg' => $M2PDMsg,

        ]);
    }

    public function expense(){


        $expenses = Expense::all();

        return view('admin.expense.all_expense',[
            'title' => 'Expense',
            'root_name' => 'Expense',
            'root' => 'Expense',
            'expenses'=>$expenses
        ]);
    }

    public function add_expense(){


        return view('admin.expense.add_expense',[
            'title' => 'Expense',
            'root_name' => 'Expense',
            'root' => 'Expense',
        ]);
    }

}
