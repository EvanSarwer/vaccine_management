<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use App\Models\VaccineTake;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;
use Barryvdh\DomPDF\Facade\Pdf;

class CommonController extends Controller
{
    public function VaccinationDetailsPdfView($id)
    {
        $vaccine_take = VaccineTake::findOrFail($id);
        $vaccine_take->user = $vaccine_take->user;
        $vaccine_take->vaccine = $vaccine_take->vaccine;
        $vaccine_take->vaccine->disease = $vaccine_take->vaccine->disease;
        $vaccine_take->center = $vaccine_take->center;

        $vaccine_doses = array();
        $dose_info = new stdClass();
        $dose_info->dose_number = 1;
        $dose_info->dose_date = Carbon::parse($vaccine_take->first_dose_date)->format('Y-m-d');
        array_push($vaccine_doses,$dose_info);
        
        if($vaccine_take->completed_doses >= $vaccine_take->vaccine->doses_required){
            $vaccine_take->vaccine_status = 'Completed';
        }else{
            $vaccine_take->vaccine_status = 'Pending';
        }

        if($vaccine_take->vaccine->doses_required > 1){
            $dose_gap_number = $vaccine_take->vaccine->dose_gap_number;
            $dose_gap_time = $vaccine_take->vaccine->dose_gap_time;
            $first_dose_date = $vaccine_take->first_dose_date;
            

            for($i = 2; $i <= $vaccine_take->vaccine->doses_required; $i++){

                if($dose_gap_number !=null && $dose_gap_time !=null){

                    $dose_date = '';
                    if($dose_gap_time == 'day'){
                        $dose_date = Carbon::parse($first_dose_date)->addDays(($i - 1) * $dose_gap_number)->format('Y-m-d');
                    }else if($dose_gap_time == 'week'){
                        $dose_date = Carbon::parse($first_dose_date)->addWeeks(($i - 1) * $dose_gap_number)->format('Y-m-d');
                    }else if($dose_gap_time == 'month'){
                        $dose_date = Carbon::parse($first_dose_date)->addMonths(($i - 1) * $dose_gap_number)->format('Y-m-d');
                    }else if($dose_gap_time == 'year'){
                        $dose_date = Carbon::parse($first_dose_date)->addYears(($i - 1) * $dose_gap_number)->format('Y-m-d');
                    }

                    $dose_info = new stdClass();   
                    $dose_info->dose_number = $i;
                    $dose_info->dose_date = $dose_date;
                    
                    array_push($vaccine_doses,$dose_info);
                    // $vaccine_take->vaccine_doses[] = [
                    //     'dose_number' => $i,
                    //     'dose_date' => $dose_date,
                    // ];

                }else{

                    $dose_info = new stdClass();   
                    $dose_info->dose_number = $i;
                    $dose_info->dose_date = 'Not Set Yet';
                    
                    array_push($vaccine_doses,$dose_info);
                }  

            }

            

            
        }

        //return view('common.vaccine_registrationDetails_pdf',compact('vaccine_take','vaccine_doses'));
    
    
        $pdf = Pdf::loadView('common.vaccine_registrationDetails_pdf',compact('vaccine_take','vaccine_doses'));
        return $pdf->stream();
    
    
    
    }


    public function VaccinationCertificatePdfView($id)
    {
        $vaccine_take = VaccineTake::findOrFail($id);
        $vaccine_take->user = $vaccine_take->user;
        $vaccine_take->vaccine = $vaccine_take->vaccine;
        $vaccine_take->vaccine->disease = $vaccine_take->vaccine->disease;
        $vaccine_take->center = $vaccine_take->center;

        $vaccine_doses = array();
        $dose_info = new stdClass();
        $dose_info->dose_number = 1;
        $dose_info->dose_date = Carbon::parse($vaccine_take->first_dose_date)->format('Y-m-d');
        array_push($vaccine_doses,$dose_info);
        
        if($vaccine_take->completed_doses >= $vaccine_take->vaccine->doses_required){
            $vaccine_take->vaccine_status = 'Completed';
        }else{
            $vaccine_take->vaccine_status = 'Pending';
        }

        if($vaccine_take->vaccine->doses_required > 1){
            $dose_gap_number = $vaccine_take->vaccine->dose_gap_number;
            $dose_gap_time = $vaccine_take->vaccine->dose_gap_time;
            $first_dose_date = $vaccine_take->first_dose_date;
            

            for($i = 2; $i <= $vaccine_take->vaccine->doses_required; $i++){

                if($dose_gap_number !=null && $dose_gap_time !=null){

                    $dose_date = '';
                    if($dose_gap_time == 'day'){
                        $dose_date = Carbon::parse($first_dose_date)->addDays(($i - 1) * $dose_gap_number)->format('Y-m-d');
                    }else if($dose_gap_time == 'week'){
                        $dose_date = Carbon::parse($first_dose_date)->addWeeks(($i - 1) * $dose_gap_number)->format('Y-m-d');
                    }else if($dose_gap_time == 'month'){
                        $dose_date = Carbon::parse($first_dose_date)->addMonths(($i - 1) * $dose_gap_number)->format('Y-m-d');
                    }else if($dose_gap_time == 'year'){
                        $dose_date = Carbon::parse($first_dose_date)->addYears(($i - 1) * $dose_gap_number)->format('Y-m-d');
                    }

                    $dose_info = new stdClass();   
                    $dose_info->dose_number = $i;
                    $dose_info->dose_date = $dose_date;
                    
                    array_push($vaccine_doses,$dose_info);
                    // $vaccine_take->vaccine_doses[] = [
                    //     'dose_number' => $i,
                    //     'dose_date' => $dose_date,
                    // ];

                }else{

                    $dose_info = new stdClass();   
                    $dose_info->dose_number = $i;
                    $dose_info->dose_date = 'Not Set Yet';
                    
                    array_push($vaccine_doses,$dose_info);
                }  

            }

            

            
        }

        //return view('common.vaccine_registrationDetails_pdf',compact('vaccine_take','vaccine_doses'));
    
        if($vaccine_take->vaccine_status == 'Completed'){

            $pdf = Pdf::loadView('common.vaccine_registrationCertificate_pdf',compact('vaccine_take','vaccine_doses'));
            return $pdf->stream();
        }else{
            return redirect()->back()->with('error','Vaccine Certificate Not Available');
        }
        
    
    
    
    }

    public function MessageSeen(){
        $user_id = Auth::user()->id;
        $unseen_messages = Notification::where('user_id',$user_id)->where('type','message')->where('status','unseen')->latest()->get();
        if(count($unseen_messages) > 0){
            foreach($unseen_messages as $message){
                $message->status = 'seen';
                $message->save();
            }
        }
        return back();
    }

    




}
