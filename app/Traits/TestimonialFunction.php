<?php
namespace App\Traits;

use App\Models\UserMainTestimonial;
use Illuminate\Http\Request;

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

    public function createNewTestimonial(Request $request)
    {

         // Handle file upload
         if ($request->hasFile('imageurl')) {
            dd("ok");
            $image = $request->file('imageurl');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Target directory outside of Laravel app directory
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/development/main/testimonies/';
            $image->move($targetDir, $imageName);
            $imagePath = "https://development.surehelp.org/main/testimonies/" . $imageName;

        }
        $testimonial_model = new UserMainTestimonial();
        $testimonial_model->written_by = $request->input("written_by");
        $testimonial_model->shortdesc = $request->input("shortdesc");
        $testimonial_model->imageurl = $imagePath ?? "";
        $testimonial_model->fulldesc_url = "";

        $testimonial_model->save();

        return redirect()->back()->with("success","Testimonial added");

    }

}