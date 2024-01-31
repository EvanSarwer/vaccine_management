<?php

namespace App\Providers;

use App\Models\PageProperty;
use App\Models\PagePropertyTab;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\SliderImage;
use Dompdf\FrameDecorator\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $page_property_view = PageProperty::first();
        if($page_property_view){

            $page_property_view->first_tab = PagePropertyTab::whereIn('id', [1,2,3])->get();
            $page_property_view->second_tab = PagePropertyTab::whereIn('id', [4,5,6])->get();
            $page_property_view->third_tab = PagePropertyTab::whereIn('id', [7,8,9])->get();

            $page_property_view->slider_images = SliderImage::all();
            View::share('page_property_view', $page_property_view);
        }
        
       
    }
}
