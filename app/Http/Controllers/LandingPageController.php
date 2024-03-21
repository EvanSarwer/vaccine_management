<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Disease;
use App\Models\SliderImage;
use App\Models\User;
use App\Models\Vaccine;
use App\Models\VaccineTake;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //

    public function index(){
        $user_count = User::where('role','user')->count();
        
        return view('main.index',compact('user_count'));
    }

    public function myVaccine(){

        $vaccines = Vaccine::all();
        foreach($vaccines as $vaccine){
            // $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->sum('completed_doses');
            // $vaccine->taken = $vaccine_taken;
            // $vaccine->taken_percent = ($vaccine_taken/$vaccine->stock_quantity)*100; 

            $vaccine->given_quantity = $vaccine->vaccine_takes->sum('completed_doses');
            $vaccine->taken_percent = $vaccine->vaccine_stocks->sum('quantity') <= 0
                    ? 0
                    : round(($vaccine->given_quantity / $vaccine->vaccine_stocks->sum('quantity')) * 100, 3);
        }

        return view('main.myVaccine',compact('vaccines'));
    }

    public function conditions(){
        $diseases = Disease::all();
        $vaccines = Vaccine::all();
        return view('main.conditions',compact('diseases','vaccines'));
    }

    public function vaccination(){
        
        $dhaka_vaccine_list = [];
        $chattogram_vaccine_list = [];
        $rajshahi_vaccine_list = [];
        $mymensingh_vaccine_list = [];
        $rangpur_vaccine_list = [];
        $sylhet_vaccine_list = [];
        $barishal_vaccine_list = [];
        $khulna_vaccine_list = [];

        $vaccines = Vaccine::all();
        foreach($vaccines as $vaccine){
            $vaccine->disease = Disease::find($vaccine->disease_id);

            $division = 'Dhaka';
            $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', $division)->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity') <= 0
                ? 0
                : round(($vaccine_taken / $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity')) * 100, 3)
            ];
            array_push($dhaka_vaccine_list,$item);

            $division = 'Chattogram';
            $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', $division)->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity') <= 0
                ? 0
                : round(($vaccine_taken / $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity')) * 100, 3)
            ];
            array_push($chattogram_vaccine_list,$item);

            $division = 'Rajshahi';
            $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', $division)->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity') <= 0
                ? 0
                : round(($vaccine_taken / $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity')) * 100, 3)
            ];
            array_push($rajshahi_vaccine_list,$item);

            $division = 'Mymensingh';
            $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', $division)->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity') <= 0
                ? 0
                : round(($vaccine_taken / $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity')) * 100, 3)
            ];
            array_push($mymensingh_vaccine_list,$item);

            $division = 'Rangpur';
            $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', $division)->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity') <= 0
                ? 0
                : round(($vaccine_taken / $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity')) * 100, 3)
            ];
            array_push($rangpur_vaccine_list,$item);

            $division = 'Sylhet';
            $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', $division)->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity') <= 0
                ? 0
                : round(($vaccine_taken / $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity')) * 100, 3)
            ];
            array_push($sylhet_vaccine_list,$item);

            $division = 'Barishal';
            $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', $division)->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity') <= 0
                ? 0
                : round(($vaccine_taken / $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity')) * 100, 3)
            ];
            array_push($barishal_vaccine_list,$item);

            $division = 'Khulna';
            $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', $division)->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity') <= 0
                ? 0
                : round(($vaccine_taken / $vaccine->vaccine_stocks->filter(function ($stock) use ($division) {
                    return $stock->center->division === $division;
                })->sum('quantity')) * 100, 3)
            ];
            array_push($khulna_vaccine_list,$item);

        }
        return view('main.vaccination',compact('dhaka_vaccine_list','chattogram_vaccine_list','rajshahi_vaccine_list','mymensingh_vaccine_list','rangpur_vaccine_list','sylhet_vaccine_list','barishal_vaccine_list','khulna_vaccine_list'));
    }

    public function blogs(){
        $blog_posts = BlogPost::all();

        return view('main.blogs',compact('blog_posts'));
    }

    public function signin(){
        return view('common.signin');
    }

    public function signup(){
        return view('common.signup');
    }
}
