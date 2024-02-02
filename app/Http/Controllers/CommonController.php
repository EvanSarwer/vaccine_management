<?php

namespace App\Http\Controllers;

use App\Models\Center;
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
        
        if($vaccine_take->completed_doses >= $vaccine_take->vaccine->doses_required){
            $vaccine_take->vaccine_status = 'Completed';
        }else{
            $vaccine_take->vaccine_status = 'Pending';
        }

        $dose_date_details = json_decode($vaccine_take->dose_date_details);
        if($dose_date_details){
            foreach($dose_date_details as $dose){
                if($dose->dose_number <= $vaccine_take->completed_doses){
                    $dose->dose_status = 'Completed';
                }else{
                    $dose->dose_status = 'Pending';
                }
            }
  
        }

        //return view('common.vaccine_registrationDetails_pdf',compact('vaccine_take','vaccine_doses'));
    
    
        $pdf = Pdf::loadView('common.vaccine_registrationDetails_pdf',compact('vaccine_take','dose_date_details'));
        return $pdf->stream();
    
    
    
    }


    public function VaccinationCertificatePdfView($id)
    {
        $vaccine_take = VaccineTake::findOrFail($id);
        $vaccine_take->user = $vaccine_take->user;
        $vaccine_take->vaccine = $vaccine_take->vaccine;
        $vaccine_take->vaccine->disease = $vaccine_take->vaccine->disease;
        $vaccine_take->center = $vaccine_take->center;
        
        if($vaccine_take->completed_doses >= $vaccine_take->vaccine->doses_required){
            $vaccine_take->vaccine_status = 'Completed';
        }else{
            $vaccine_take->vaccine_status = 'Pending';
        }

        $dose_date_details = json_decode($vaccine_take->dose_date_details);
        if($dose_date_details){
            foreach($dose_date_details as $dose){
                if($dose->dose_number <= $vaccine_take->completed_doses){
                    $dose->dose_status = 'Completed';
                }else{
                    $dose->dose_status = 'Pending';
                }
            }
  
        }

        //return view('common.vaccine_registrationDetails_pdf',compact('vaccine_take','vaccine_doses'));
    
        if($vaccine_take->vaccine_status == 'Completed'){

            $pdf = Pdf::loadView('common.vaccine_registrationCertificate_pdf',compact('vaccine_take','dose_date_details'));
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


    public function DivisionToCenter($division){
        $centers = Center::where('division',$division)->get();
        return response()->json($centers);
    }

    




}
