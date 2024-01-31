<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\PageProperty;
use App\Models\PagePropertyTab;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class PropertyOperationController extends Controller
{
    
    public function PagePropertyEditView(){
        $slider_images = SliderImage::all();

        $page_property = PageProperty::first();

        $page_property->first_tab = PagePropertyTab::whereIn('id', [1,2,3])->get();
        $page_property->second_tab = PagePropertyTab::whereIn('id', [4,5,6])->get();
        $page_property->third_tab = PagePropertyTab::whereIn('id', [7,8,9])->get();

        $page_property->blog_posts = BlogPost::all();

            
        return view('admin_user.admin.pageProperty.edit_page_property',compact('slider_images','page_property'));
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


    public function PagePropertyEditPost(Request $request){
        // Validation
        $request->validate([

            'title' => 'required',
            'subtitle' => 'required',
            'testimonial_text' => 'required',
            'testimonial_author_name' => 'required',
            'testimonial_author_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
            'vaccination_title1' => 'required',
            'vaccination_description1' => 'required',
            'vaccination_image1' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
            'vaccination_title2' => 'required',
            'vaccination_description2' => 'required',
            'vaccination_image2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
            'vaccination_title3' => 'required',
            'vaccination_description3' => 'required',
            'vaccination_image3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],

        ]);


        $page_property = PageProperty::first();
        $page_property->title = $request->title;
        $page_property->subtitle = $request->subtitle;
        $page_property->testimonial_text = $request->testimonial_text;
        $page_property->testimonial_author_name = $request->testimonial_author_name;
        $page_property->vaccination_title1 = $request->vaccination_title1;
        $page_property->vaccination_description1 = $request->vaccination_description1;
        $page_property->vaccination_title2 = $request->vaccination_title2;
        $page_property->vaccination_description2 = $request->vaccination_description2;
        $page_property->vaccination_title3 = $request->vaccination_title3;
        $page_property->vaccination_description3 = $request->vaccination_description3;

        if($request->hasfile('testimonial_author_photo')){
            $destination = 'page_assets/img/'.$page_property->testimonial_author_photo;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('testimonial_author_photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            //$img = Image::make(file_get_contents($file));
            //$img->save(\public_path('page_assets/img/'.$filename),60);
            $file->move(public_path('page_assets/img'),$filename);
            $page_property['testimonial_author_photo'] = $filename;
        }

        if($request->hasfile('vaccination_image1')){
            $destination = 'page_assets/img/'.$page_property->vaccination_image1;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('vaccination_image1');
            $filename = date('YmdHi').$file->getClientOriginalName();
            //$img = Image::make(file_get_contents($file));
            //$img->save(\public_path('page_assets/img/'.$filename),60);
            $file->move(public_path('page_assets/img'),$filename);
            $page_property['vaccination_image1'] = $filename;
        }

        if($request->hasfile('vaccination_image2')){
            $destination = 'page_assets/img/'.$page_property->vaccination_image2;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('vaccination_image2');
            $filename = date('YmdHi').$file->getClientOriginalName();
            //$img = Image::make(file_get_contents($file));
            //$img->save(\public_path('page_assets/img/'.$filename),60);
            $file->move(public_path('page_assets/img'),$filename);
            $page_property['vaccination_image2'] = $filename;
        }

        if($request->hasfile('vaccination_image3')){
            $destination = 'page_assets/img/'.$page_property->vaccination_image3;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('vaccination_image3');
            $filename = date('YmdHi').$file->getClientOriginalName();
            //$img = Image::make(file_get_contents($file));
            //$img->save(\public_path('page_assets/img/'.$filename),60);
            $file->move(public_path('page_assets/img'),$filename);
            $page_property['vaccination_image3'] = $filename;
        }

        $page_property->save();

        $notification = array(
            'message' => 'Page Property Updated Successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);


    }


    public function PagePropertyFirstTabEditPost(Request $request){
        // Validation
        $request->validate([
            'tab_name' => 'required',
            'title1' => 'required',
            'description1' => 'required',
            'image1' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
            'title2' => 'required',
            'description2' => 'required',
            'image2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
            'title3' => 'required',
            'description3' => 'required',
            'image3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],

        ]);

        $page_property_tab = PagePropertyTab::whereIn('id', [1,2,3])->get();
        if($page_property_tab && $page_property_tab->count() > 0){
            foreach($page_property_tab as $key => $value){
                $value->tab_name = $request->tab_name;
                $value->title = $request->{"title".($key+1)};
                $value->description = $request->{"description".($key+1)};

                if($request->hasfile('image'.($key+1))){
                    $destination = 'page_assets/img/'.$value->image;
                    if(File::exists($destination)){
                        File::delete($destination);
                    }
                    $file = $request->file('image'.($key+1));
                    $filename = date('YmdHi').$file->getClientOriginalName();
                    //$img = Image::make(file_get_contents($file));
                    //$img->save(\public_path('page_assets/img/'.$filename),60);
                    $file->move(public_path('page_assets/img'),$filename);
                    $value['image'] = $filename;
                }

                $value->save();
            }
        }

        $notification = array(
            'message' => 'Page Property First Tab Updated Successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }


    public function PagePropertySecondTabEditPost(Request $request){
        // Validation
        $request->validate([
            'tab_name' => 'required',
            'title1' => 'required',
            'description1' => 'required',
            'image1' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
            'title2' => 'required',
            'description2' => 'required',
            'image2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
            'title3' => 'required',
            'description3' => 'required',
            'image3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],

        ]);

        $page_property_tab = PagePropertyTab::whereIn('id', [4,5,6])->get();
        if($page_property_tab && $page_property_tab->count() > 0){
            foreach($page_property_tab as $key => $value){
                $value->tab_name = $request->tab_name;
                $value->title = $request->{"title".($key+1)};
                $value->description = $request->{"description".($key+1)};

                if($request->hasfile('image'.($key+1))){
                    $destination = 'page_assets/img/'.$value->image;
                    if(File::exists($destination)){
                        File::delete($destination);
                    }
                    $file = $request->file('image'.($key+1));
                    $filename = date('YmdHi').$file->getClientOriginalName();
                    //$img = Image::make(file_get_contents($file));
                    //$img->save(\public_path('page_assets/img/'.$filename),60);
                    $file->move(public_path('page_assets/img'),$filename);
                    $value['image'] = $filename;
                }

                $value->save();
            }
        }

        $notification = array(
            'message' => 'Page Property Second Tab Updated Successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }


    public function PagePropertyThirdTabEditPost(Request $request){
        // Validation
        $request->validate([
            'tab_name' => 'required',
            'title1' => 'required',
            'description1' => 'required',
            'image1' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
            'title2' => 'required',
            'description2' => 'required',
            'image2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
            'title3' => 'required',
            'description3' => 'required',
            'image3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],

        ]);

        $page_property_tab = PagePropertyTab::whereIn('id', [7,8,9])->get();
        if($page_property_tab && $page_property_tab->count() > 0){
            foreach($page_property_tab as $key => $value){
                $value->tab_name = $request->tab_name;
                $value->title = $request->{"title".($key+1)};
                $value->description = $request->{"description".($key+1)};

                if($request->hasfile('image'.($key+1))){
                    $destination = 'page_assets/img/'.$value->image;
                    if(File::exists($destination)){
                        File::delete($destination);
                    }
                    $file = $request->file('image'.($key+1));
                    $filename = date('YmdHi').$file->getClientOriginalName();
                    //$img = Image::make(file_get_contents($file));
                    //$img->save(\public_path('page_assets/img/'.$filename),60);
                    $file->move(public_path('page_assets/img'),$filename);
                    $value['image'] = $filename;
                }

                $value->save();
            }
        }

        $notification = array(
            'message' => 'Page Property Third Tab Updated Successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }


    public function AddBlogPost(Request $request){
        // Validation
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
            'blog_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
            
        ]);

        $blog_post = new BlogPost();
        $blog_post->title = $request->title;
        $blog_post->description = $request->description;
        $blog_post->link = $request->link;

        if($request->hasfile('blog_image')){
            $file = $request->file('blog_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            //$img = Image::make(file_get_contents($file));
            //$img->save(\public_path('page_assets/img/'.$filename),60);
            $file->move(public_path('page_assets/img'),$filename);
            $blog_post['image'] = $filename;
        }

        $blog_post->save();

        $notification = array(
            'message' => 'Blog Post Added Successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function BlogPostDelete($id){
        $blog_post = BlogPost::findOrFail($id);
        $destination = 'page_assets/img/'.$blog_post->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $blog_post->delete();

        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }


}
