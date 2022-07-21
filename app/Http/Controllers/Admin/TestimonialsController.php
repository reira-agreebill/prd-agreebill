<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Testimonial;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TestimonialsController extends Controller
{

    public function  __construct()
    {
        $this->middleware('auth');
    }
    public function delete_testimonials(Request $request)
    {

        Testimonial::destroy($request->id);

        return back()->with(Toastr::success('Testimonials Deleted successfully ','Success'));

    }

    // testimonials
    public function add_testimonials(){
        return view('admin.testimonials.add',[
            'title' => 'Testimonials',
            'root' => 'Testimonials',
            'root_name' => 'Testimonials'
        ]);
    }


    public function create_testimonials(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'designation' => '',
            'comment' => '',
        ]);


        if (Testimonial::create($data))
            return Redirect::route( "testimonials" )->with(Toastr::success('Testimonials Added successfully ','Success'));
    }

}
