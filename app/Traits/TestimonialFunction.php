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
                $imageExtension = $image->getClientOriginalExtension(); // Get the original file extension
                $imageName = time() . '.' . $imageExtension; // Combine time with the file extension
            
                // Define target directory inside the public directory
                $targetDir = public_path('uploads/images/testimonies');
                
                // Move the file to the target directory
                $image->move($targetDir, $imageName);
            
                // Create the URL for the image
                $imagePath = asset('uploads/images/testimonies/' . $imageName);
            
                $testimonial_model = new UserMainTestimonial();
                $testimonial_model->written_by = $request->input('written_by');
                $testimonial_model->shortdesc = $request->input('shortdesc');
                $testimonial_model->imageurl = $imagePath;
                $testimonial_model->fulldesc_url = '';
            
                $testimonial_model->save();
            
                return redirect()->back()->with('success', 'Testimonial added');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error in uploading file: ' . $e->getMessage());
        }
    }
    

}