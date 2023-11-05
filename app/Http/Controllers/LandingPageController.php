<?php

namespace App\Http\Controllers;

use App\Models\Disease;
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
            $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->sum('completed_doses');
            $vaccine->taken = $vaccine_taken;
            $vaccine->taken_percent = ($vaccine_taken/$vaccine->stock_quantity)*100;
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

            $dhaka_vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', 'Dhaka')->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => ($dhaka_vaccine_taken / $vaccine->stock_quantity) * 100
            ];
            array_push($dhaka_vaccine_list,$item);

            $chattogram_vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', 'Chattogram')->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => ($chattogram_vaccine_taken / $vaccine->stock_quantity) * 100
            ];
            array_push($chattogram_vaccine_list,$item);

            $rajshahi_vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', 'Rajshahi')->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => ($rajshahi_vaccine_taken / $vaccine->stock_quantity) * 100
            ];
            array_push($rajshahi_vaccine_list,$item);

            $mymensingh_vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', 'Mymensingh')->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => ($mymensingh_vaccine_taken / $vaccine->stock_quantity) * 100
            ];
            array_push($mymensingh_vaccine_list,$item);

            $rangpur_vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', 'Rangpur')->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => ($rangpur_vaccine_taken / $vaccine->stock_quantity) * 100
            ];
            array_push($rangpur_vaccine_list,$item);

            $sylhet_vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', 'Sylhet')->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => ($sylhet_vaccine_taken / $vaccine->stock_quantity) * 100
            ];
            array_push($sylhet_vaccine_list,$item);

            $barishal_vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', 'Barishal')->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => ($barishal_vaccine_taken / $vaccine->stock_quantity) * 100
            ];
            array_push($barishal_vaccine_list,$item);

            $khulna_vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->where('division', 'Khulna')->sum('completed_doses');
            $item = (object)[
                'vaccine' => $vaccine,
                'vaccine_taken_percent' => ($khulna_vaccine_taken / $vaccine->stock_quantity) * 100
            ];
            array_push($khulna_vaccine_list,$item);

        }
        return view('main.vaccination',compact('dhaka_vaccine_list','chattogram_vaccine_list','rajshahi_vaccine_list','mymensingh_vaccine_list','rangpur_vaccine_list','sylhet_vaccine_list','barishal_vaccine_list','khulna_vaccine_list'));
    }

    public function signin(){
        return view('common.signin');
    }

    public function signup(){
        return view('common.signup');
    }
}
