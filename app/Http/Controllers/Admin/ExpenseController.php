<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;

class ExpenseController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }
    public function create(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'amount' => 'required',
            'date' => '',
            'note' => '',
        ]);


        if (Expense::create($data))
            return Redirect::route( "expense" )->with(Toastr::success('Expense Added successfully ','Success'));
    }

    public function delete(Request $request)
    {

        Expense::destroy($request->id);

        return back()->with(Toastr::success('Expense Deleted successfully ','Success'));

    }


    public function edit(Expense $id){

        $head_name="Edit Expense";

        return view('admin.expense.edit_expense',compact('id'),
            [
                'title' => 'Expense',
                'root_name' => 'Update Expense',
                'root' => 'Expense',
            ]);
    }
    public function update(Request $request,$id){

        $data = request()->validate([
            'name'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'note'=>'',

        ]);


        if(Expense::whereId($id)->update($data)) {
            return Redirect::route( "expense" )->with(Toastr::success('Expense Updated successfully ','Success'));
        }
    }
}
