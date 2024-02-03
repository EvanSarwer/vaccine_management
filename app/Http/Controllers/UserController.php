<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\User;
use App\Models\Vaccine;
use App\Models\VaccineTake;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use stdClass;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Notification;
use App\Models\VaccineStock;

class UserController extends Controller
{
    //
    public function index(){
        $user_id = Auth::user()->id;
        $vaccine_takes = VaccineTake::where('user_id',$user_id)->orderBy('order_date', 'desc')->get();
        foreach($vaccine_takes as $vaccine_take){
            $vaccine_take->user = $vaccine_take->user;
            $vaccine_take->vaccine = $vaccine_take->vaccine;
            $vaccine_take->center = $vaccine_take->center;
            $dose_date_details = json_decode($vaccine_take->dose_date_details);
            $vaccine_take->first_dose_date = $dose_date_details[0]->dose_date;
        }
        return view('admin_user.user.index', compact('vaccine_takes'));
    }


    public function UserProfileInfo(){
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        return view('admin_user.user.user_profile_view', compact('userData'));

    }

    public function UserProfileUpdate(Request $request){
        $user_id = Auth::user()->id;

        // Validation
        $request->validate([
            'username' => 'required|min:4|unique:users,username,'.$user_id,
            'email' => 'required|min:6|unique:users,email,'.$user_id,
            'dob' => 'required|date',
            'phone' => 'required|min:11',
            'address' => 'required',
        ]);

        $userData = User::find($user_id);
        $userData->username = $request->username;
        $userData->email = $request->email;
        $userData->dob = $request->dob;
        $userData->phone = $request->phone;
        $userData->address = $request->address;

        if($request->hasfile('photo')){
            $destination = 'page_assets/img/'.$userData->photo;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('page_assets/img/'),$filename);
            $userData['photo'] = $filename;
        }
        $userData->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function UserChangePassword(){
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        return view('admin_user.user.user_change_password', compact('userData'));

    }

    public function UserPasswordUpdate(Request $request){
        // Validation
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => ['required', Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised(), 'same:reNewPassword'],
            'reNewPassword' => 'required|min:8'
        ],[
            'newPassword.same' => 'The new password and confirm password does not match'
        ]);

        // Match old password
        if(!Hash::check($request->oldPassword, auth::user()->password)){
            $notification = array(
                'message' => 'Current password does not match!',
                'alert-type' => 'error',
            );
    
            return back()->with($notification);
        }

        // Update new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->newPassword)
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);

    }



    ///////// Vaccination Status /////////
    public function VaccinationDetailsView($id){
        $vaccine_take = VaccineTake::findOrFail($id);
        $vaccine_take->user = $vaccine_take->user;
        $vaccine_take->vaccine = $vaccine_take->vaccine;
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

        return view('admin_user.user.vaccination_details',compact('vaccine_take','dose_date_details'));
    }


    public function VaccineRegistrationView(){
        $vaccines = Vaccine::all();
        return view('admin_user.user.vaccine_registration',compact('vaccines'));
    }

    public function VaccineRegistrationPost(Request $request){
        // Validation
        $request->validate([
            'vaccine_id' => 'required',
            'division' => 'required',
            'center_id' => 'required',
        ]);

        $user_id = Auth::user()->id;

        $vaccine = Vaccine::findOrFail($request->vaccine_id);
        //vaccine availability check
        $vaccine_stock_check = VaccineStock::where('vaccine_id',$request->vaccine_id)->where('center_id',$request->center_id)->first();
        if(!$vaccine_stock_check){
            $notification = array(
                'message' => 'Vaccine is not available, Try again later',
                'alert-type' => 'error',
            );
    
            return redirect('/user/dashboard')->with($notification);
        }else{
            if($vaccine_stock_check->available <= 0){
                $notification = array(
                    'message' => 'Vaccine is not available, Try again later',
                    'alert-type' => 'error',
                );
        
                return redirect('/user/dashboard')->with($notification);
            }else{
                $booked_vaccine = VaccineTake::where('vaccine_id', $request->vaccine_id)
                    ->where('center_id', $request->center_id)
                    ->get(); // Retrieve the records

                $total_booked_vaccine = $booked_vaccine->sum(function ($vaccineTake) use ($vaccine) {
                    return $vaccine->doses_required - $vaccineTake->completed_doses;
                });
                if($vaccine_stock_check->available <= $total_booked_vaccine){
                    $notification = array(
                        'message' => 'Vaccine is not available, Try again later',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/user/dashboard')->with($notification);
                }
            }
        }


        //Already assigned vaccine check
        $vaccine_take_histories = VaccineTake::where('user_id',$user_id)->get();
        if($vaccine_take_histories && $vaccine_take_histories->count() > 0){

            foreach($vaccine_take_histories as $vaccine_take_history){
                if($vaccine_take_history->vaccine_id == $request->vaccine_id){
                    $notification = array(
                        'message' => 'Already registered for this vaccine',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/user/dashboard')->with($notification);
                }


                if(($vaccine_take_history->vaccine->doses_required - $vaccine_take_history->completed_doses) > 0){
                    $dose_date_details = json_decode($vaccine_take_history->dose_date_details);
                    $last_dose_date = $dose_date_details[($vaccine_take_history->vaccine->doses_required - 1)]->dose_date;
                    if($last_dose_date >= Carbon::now()->format('Y-m-d')){
                        $notification = array(
                            'message' => 'You are not eligible for this vaccine yet',
                            'alert-type' => 'error',
                        );
                
                        return redirect('/user/dashboard')->with($notification);
                    }
                }
            }
        }

        $center = Center::where('division',$request->division)->first();

        $vaccine_take = new VaccineTake();

        $vaccine_take->user_id = $user_id;
        $vaccine_take->vaccine_id = $request->vaccine_id;
        $vaccine_take->division = $request->division;
        $vaccine_take->center_id = $center->id;
        $patient = User::find($user_id);
        if($patient){
            $vaccine_take->patient_nid = $patient->nid;
        }
        $vaccine_take->order_date = Carbon::now()->format('Y-m-d');
        
        // Create an array to store dose details
        $doseDetails = [];
        $nextDoseDate = Carbon::parse($vaccine_take->order_date)->addDays(14);
        for ($doseNumber = 1; $doseNumber <= $vaccine->doses_required; $doseNumber++) {
            // Add dose details to the array
            $doseDetails[] = [
                'dose_number' => $doseNumber,
                'dose_date' => $nextDoseDate->toDateString(),
            ];
    
            // Calculate the next dose date by adding the dose gap
            if($vaccine->dose_gap_number !=null && $vaccine->dose_gap_time !=null){
              
                if($vaccine->dose_gap_time == 'day'){
                    $nextDoseDate->addDays($vaccine->dose_gap_number)->format('Y-m-d');
                }else if($vaccine->dose_gap_time == 'week'){
                    $nextDoseDate->addWeeks($vaccine->dose_gap_number)->format('Y-m-d');
                }else if($vaccine->dose_gap_time == 'month'){
                    $nextDoseDate->addMonths($vaccine->dose_gap_number)->format('Y-m-d');
                }else if($vaccine->dose_gap_time == 'year'){
                    $nextDoseDate->addYears($vaccine->dose_gap_number)->format('Y-m-d');
                }
            }
        }
        // Convert the array to JSON and store in the database
        $vaccine_take->dose_date_details = json_encode($doseDetails);
        $vaccine_take->save();

        $mailData = [
            'subject' => 'Vaccination Registration Successful',
            'title' => 'Vaccine Management System',
            'user_name' => $vaccine_take->user->username,
            'vaccine' => $vaccine_take->vaccine->name,
            'registration_date' => $vaccine_take->order_date,
            'first_dose_date' => $doseDetails[0]['dose_date'],
        ];

        Mail::to($vaccine_take->user->email)->send(new SendMail($mailData));

        $notification = array(
            'message' => 'Vaccine Registration Successful',
            'alert-type' => 'success',
        );

        return redirect('/user/dashboard')->with($notification);

    }


    ///////////// Vaccine Wise Operation /////////////
    public function VaccineList(){
        $vaccines = Vaccine::all();
        foreach($vaccines as $vaccine){
            $vaccine->available_quantity = $vaccine->vaccine_stocks->sum(function ($stock) {
                return $stock->available + $stock->reserved;
            });
            $vaccine->booked_quantity = $vaccine->vaccine_takes->sum(function ($vaccineTake) use ($vaccine) {
                return $vaccine->doses_required - $vaccineTake->completed_doses;
            });
            $vaccine->given_quantity = $vaccine->vaccine_takes->sum('completed_doses');
            $vaccine->disease_name = $vaccine->disease->name;

            $vaccine->vaccine_taken_percent = $vaccine->vaccine_stocks->sum('quantity') <= 0
    ? 0
    : round(($vaccine->given_quantity / $vaccine->vaccine_stocks->sum('quantity')) * 100, 4);
            
        }
        return view('admin_user.user.vaccine_list',compact('vaccines'));
    }


    public function VaccineWiseRegistrationView($id){
        $vaccine = Vaccine::findOrFail($id);
        return view('admin_user.user.vaccineWise_registration',compact('vaccine'));
    }



    // All Notification Message ///
    public function MessageList(){
        $user_id = Auth::user()->id;
        $messages = Notification::where('user_id',$user_id)->where('type','message')->orderBy('status', 'desc')->orderBy('created_at', 'desc')->get();
        foreach($messages as $message){
            $message->fromUser = User::Where('email',$message->email)->first();
            $message->deliver_time = Carbon::parse($message->created_at)->diffForHumans();

        }
        return view('admin_user.user.message_list',compact('messages'));
    }





}
