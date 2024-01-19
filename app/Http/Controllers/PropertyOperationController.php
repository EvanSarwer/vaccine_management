<?php

namespace App\Http\Controllers;

use App\Models\SliderImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class PropertyOperationController extends Controller
{
    
    public function PagePropertyEditView(){
        $slider_images = SliderImage::all();
            
        return view('admin_user.admin.pageProperty.edit_page_property',compact('slider_images'));
    }


    public function AddSliderImage(Request $request){
        // Validation
        $request->validate([
            'slider_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
        ]);

        $slider_image = new SliderImage();

        if($request->hasfile('slider_image')){
            $file = $request->file('slider_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            //$img = Image::make(file_get_contents($file));
            //$img->save(\public_path('page_assets/img/'.$filename),60);
            $file->move(public_path('page_assets/img'),$filename);
            $slider_image['image'] = $filename;

            $slider_image->save();

            $notification = array(
                'message' => 'Slider Image Added Successfully',
                'alert-type' => 'success',
            );
            return back()->with($notification);
        }

        $notification = array(
            'message' => 'Slider Image Not Added',
            'alert-type' => 'error',
        );
        return back()->with($notification);

    }

    public function SliderImageDelete($id){
        $slider_image = SliderImage::findOrFail($id);
        $destination = 'page_assets/img/'.$slider_image->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $slider_image->delete();

        $notification = array(
            'message' => 'Slider Image Deleted Successfully',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }



}
