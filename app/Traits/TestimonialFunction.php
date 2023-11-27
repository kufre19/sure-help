<?php
namespace App\Traits;

use App\Models\UserMainTestimonial;

trait TestimonialFunction {


    public function testimonial_page()
    {
        $testimonials = UserMainTestimonial::paginate(15);
        return view("testimonial.index",compact("testimonials"));
    }

    public function delete_testimonial($id)
    {
        UserMainTestimonial::where("id",$id)->delete();
        return redirect()->back()->with("success","Testimonial deleted!");
    }

}