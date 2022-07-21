<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TranslationService;
use App\Models\Setting;
use App\Models\UserExpense;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;

class ExpenseController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:store');
    }


    public function add(){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.expense.add_expense',[
            'title' => 'Expense',
            'root_name' => 'Expense',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$transation->languages(),
            'selected_language' => $transation->selected_language()
        ]);
    }

    public function create(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'note' => '',
        ]);

        $data['store_id'] = auth()->id();

        if (UserExpense::create($data))
            return Redirect::route( "store_admin.store_expense" )->with(Toastr::success('Expense Added successfully ','Success'));
    }


    public function edit(UserExpense $id){
        $transation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $head_name="Edit Expense";

        return view('restaurants.expense.edit_expense',compact('id'),
            [
                'title' => 'Expense',
                'root_name' => 'Update Expense',
                'root' => 'Expense',
                'sanboxNumber'=>$sanboxNumber,
                'languages'=>$transation->languages(),
                'selected_language' => $transation->selected_language()
            ]);
    }

    public function update(Request $request,$id){

        $data = request()->validate([
            'name'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'note'=>'',

        ]);

        $data['store_id'] = auth()->id();


        if(UserExpense::whereId($id)->update($data)) {
            return Redirect::route( "store_admin.store_expense" )->with(Toastr::success('Expense Updated successfully ','Success'));
        }
    }


    public function delete(Request $request)
    {

        UserExpense::destroy($request->id);

        return back()->with(Toastr::success('Expense Deleted successfully ','Success'));

    }





}
