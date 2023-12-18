<?php
namespace App\Traits;

use App\Models\UserMainTestimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
        $request->validate([
            'written_by' => 'required|string|max:255',
            'shortdesc' => 'required|string',
            'imageurl' => 'required|image',
        ]);
    
        try {
            if ($request->hasFile('imageurl')) {
                $image = $request->file('imageurl');
                $imageName = time() . '_' . $image->getClientOriginalName();
    
                // Save to the 'public' disk (or any configured disk)
                $imagePath = $image->storeAs('uploads/images/testimonies', $imageName, 'public');
    
                $testimonial_model = new UserMainTestimonial();
                $testimonial_model->written_by = $request->input('written_by');
                $testimonial_model->shortdesc = $request->input('shortdesc');
                $testimonial_model->imageurl = Storage::disk('public')->url($imagePath);
                $testimonial_model->fulldesc_url = '';
    
                $testimonial_model->save();
    
                return redirect()->back()->with('success', 'Testimonial added');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error in uploading file: ' . $e->getMessage());
        }
    }
    

}