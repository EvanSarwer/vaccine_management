<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Center;
use App\Models\Notification;
use App\Models\User;
use App\Models\Vaccine;
use App\Models\VaccineStock;
use App\Models\VaccineTake;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class CenterUserController extends Controller
{
    //
    public function index(){
        $user_id = Auth::user()->id;
        $center = Center::where('center_user_id',$user_id)->first();
        $vaccine_takes = VaccineTake::where('center_id',$center->id)->orWhere('user_id', $user_id)->orderBy('order_date', 'desc')->get();
        foreach($vaccine_takes as $vaccine_take){
            $vaccine_take->user = $vaccine_take->user;
            $vaccine_take->vaccine = $vaccine_take->vaccine;
            $vaccine_take->center = $vaccine_take->center;
            $dose_date_details = json_decode($vaccine_take->dose_date_details);
            $vaccine_take->first_dose_date = $dose_date_details[0]->dose_date;
        }

        $vaccine_takes_all = VaccineTake::all();
        foreach($vaccine_takes_all as $vaccine_take){
            $vaccine_take->user = $vaccine_take->user;
            $vaccine_take->vaccine = $vaccine_take->vaccine;
            $vaccine_take->center = $vaccine_take->center;
            $dose_date_details = json_decode($vaccine_take->dose_date_details);
            $vaccine_take->first_dose_date = $dose_date_details[0]->dose_date;
        }
        return view('admin_user.center.index', compact('vaccine_takes','vaccine_takes_all','center'));
    }


    public function CenterUserProfileInfo(){
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        return view('admin_user.center.centerUser_profile_view', compact('userData'));

    }

    public function CenterUserProfileUpdate(Request $request){
        $user_id = Auth::user()->id;

        // Validation
        $request->validate([
            'username' => 'required|min:4|unique:users,username,'.$user_id,
            'email' => 'required|min:6|unique:users,email,'.$user_id,
            'phone' => 'required|min:11',
            'address' => 'required',
        ]);

        $userData = User::find($user_id);
        $userData->username = $request->username;
        $userData->email = $request->email;
        $userData->phone = $request->phone;
        $userData->address = $request->address;

        if($request->hasfile('photo')){
            $destination = 'page_assets/img/'.$userData->photo;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('page_assets/img'),$filename);
            $userData['photo'] = $filename;
        }
        $userData->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }


    public function CenterUserChangePassword(){
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        return view('admin_user.center.centerUser_change_password', compact('userData'));

    }

    public function CenterUserPasswordUpdate(Request $request){
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


    //////// Vaccines Operation ////////////////

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
        }
        return view('admin_user.center.vaccine_list',compact('vaccines'));
    }




    ///// Vaccination Registration

    public function VaccineRegistrationView(){
        $users = User::where('role', 'user')->get();
        $vaccines = Vaccine::all();
        return view('admin_user.center.vaccine_registration',compact('vaccines','users'));
    }

    public function VaccineRegistrationPost(Request $request){
        // Validation
        $request->validate([
            'user_id' => 'required',
            'vaccine_id' => 'required',
            'division' => 'required',
            'center_id' => 'required',
        ]);

        $vaccine = Vaccine::findOrFail($request->vaccine_id);

        //vaccine availability check
        $vaccine_stock_check = VaccineStock::where('vaccine_id',$request->vaccine_id)->where('center_id',$request->center_id)->first();
        if(!$vaccine_stock_check){
            $notification = array(
                'message' => 'Vaccine is not available, Try again later',
                'alert-type' => 'error',
            );
    
            return redirect('/center/dashboard')->with($notification);
        }else{
            if($vaccine_stock_check->available <= 0){
                $notification = array(
                    'message' => 'Vaccine is not available, Try again later',
                    'alert-type' => 'error',
                );
        
                return redirect('/center/dashboard')->with($notification);
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
            
                    return redirect('/center/dashboard')->with($notification);
                }
            }
        }

        //Already assigned vaccine check
        $vaccine_take_histories = VaccineTake::where('user_id',$request->user_id)->get();
        if($vaccine_take_histories && $vaccine_take_histories->count() > 0){

            foreach($vaccine_take_histories as $vaccine_take_history){
                if($vaccine_take_history->vaccine_id == $request->vaccine_id){
                    $notification = array(
                        'message' => 'User already registered for this vaccine',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/center/dashboard')->with($notification);
                }


                if(($vaccine_take_history->vaccine->doses_required - $vaccine_take_history->completed_doses) > 0){
                    $dose_date_details = json_decode($vaccine_take_history->dose_date_details);
                    $last_dose_date = $dose_date_details[($vaccine_take_history->vaccine->doses_required - 1)]->dose_date;
                    if($last_dose_date >= Carbon::now()->format('Y-m-d')){
                        $notification = array(
                            'message' => 'User is not eligible for this vaccine yet',
                            'alert-type' => 'error',
                        );
                
                        return redirect('/center/dashboard')->with($notification);
                    }
                }
            }
        }

        $center = Center::where('division',$request->division)->first();

        $vaccine_take = new VaccineTake();

        $vaccine_take->user_id = $request->user_id;   // registered by
        $vaccine_take->vaccine_id = $request->vaccine_id;
        $vaccine_take->division = $request->division;
        $vaccine_take->center_id = $center->id;
        $patient = User::find($request->user_id);
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

        return redirect('/center/dashboard')->with($notification);

    }


    public function UnderprivilegedVaccineRegistrationView(){
        $vaccines = Vaccine::all();
        return view('admin_user.center.underprivilegedRegistration.vaccine_registration',compact('vaccines'));
    }

    public function UnderprivilegedVaccineRegistrationPost(Request $request){
        // Validation
        $request->validate([
            'patient_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'patient_name' => 'required',
            'patient_phone' => 'required',
            'patient_address' => 'required',
            'patient_dob' => 'required|date',
            'patient_nid' => 'required|string|min:6|max:15',
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
    
            return redirect('/center/dashboard')->with($notification);
        }else{
            if($vaccine_stock_check->reserved <= 0){
                $notification = array(
                    'message' => 'Vaccine is not available, Try again later',
                    'alert-type' => 'error',
                );
        
                return redirect('/center/dashboard')->with($notification);
            }else{
                $booked_vaccine = VaccineTake::where('vaccine_id', $request->vaccine_id)
                    ->where('center_id', $request->center_id)
                    ->get(); // Retrieve the records

                $total_booked_vaccine = $booked_vaccine->sum(function ($vaccineTake) use ($vaccine) {
                    return $vaccine->doses_required - $vaccineTake->completed_doses;
                });
                if($vaccine_stock_check->reserved <= $total_booked_vaccine){
                    $notification = array(
                        'message' => 'Vaccine is not available, Try again later',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/center/dashboard')->with($notification);
                }
            }
        }

        //Already assigned vaccine check
        $vaccine_take_histories = VaccineTake::where('patient_nid',$request->patient_nid)->get();
        if($vaccine_take_histories && $vaccine_take_histories->count() > 0){

            foreach($vaccine_take_histories as $vaccine_take_history){
                if($vaccine_take_history->vaccine_id == $request->vaccine_id){
                    $notification = array(
                        'message' => 'User already registered for this vaccine',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/center/dashboard')->with($notification);
                }


                if(($vaccine_take_history->vaccine->doses_required - $vaccine_take_history->completed_doses) > 0){
                    $dose_date_details = json_decode($vaccine_take_history->dose_date_details);
                    $last_dose_date = $dose_date_details[($vaccine_take_history->vaccine->doses_required - 1)]->dose_date;
                    if($last_dose_date >= Carbon::now()->format('Y-m-d')){
                        $notification = array(
                            'message' => 'User is not eligible for this vaccine yet',
                            'alert-type' => 'error',
                        );
                
                        return redirect('/center/dashboard')->with($notification);
                    }
                }
            }
        }

        $center = Center::where('division',$request->division)->first();

        $vaccine_take = new VaccineTake();

        $vaccine_take->user_id = $user_id;   // registered by user
        $vaccine_take->vaccine_id = $request->vaccine_id;
        $vaccine_take->division = $request->division;
        $vaccine_take->center_id = $center->id;

        $vaccine_take->patient_name = $request->patient_name;
        $vaccine_take->patient_phone = $request->patient_phone;
        $vaccine_take->patient_address = $request->patient_address;
        $vaccine_take->patient_dob = $request->patient_dob;
        $vaccine_take->patient_nid = $request->patient_nid;

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

        //patient photo upload
        if ($request->hasFile('patient_photo')) {
            $file = $request->file('patient_photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('page_assets/img'),$filename);
            $vaccine_take['patient_photo'] = $filename;
            
        }
        $vaccine_take->save();

        $mailData = [
            'subject' => 'Vaccination Registration Successful',
            'title' => 'Vaccine Management System',
            'user_name' => $vaccine_take->patient_name,
            'vaccine' => $vaccine_take->vaccine->name,
            'registration_date' => $vaccine_take->order_date,
            'first_dose_date' => $doseDetails[0]['dose_date'],
        ];

        Mail::to($vaccine_take->user->email)->send(new SendMail($mailData));

        $notification = array(
            'message' => 'Vaccine Registration Successful',
            'alert-type' => 'success',
        );

        return redirect('/center/dashboard')->with($notification);

    }


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

        return view('admin_user.center.vaccination_details',compact('vaccine_take','dose_date_details'));
    }



    public function VaccineRegistrationUpdateView($id){
        $vaccine_take = VaccineTake::findOrFail($id);
        $vaccine_take->user = $vaccine_take->user;
        $vaccine_take->vaccine = $vaccine_take->vaccine;
        $vaccine_take->center = $vaccine_take->center;

        $dose_date_details = json_decode($vaccine_take->dose_date_details);
        if($dose_date_details){
            foreach($dose_date_details as $dose){
                if($dose->dose_number <= $vaccine_take->completed_doses){
                    $dose->dose_status = 'completed';
                }else{
                    $dose->dose_status = 'pending';
                }
            }
        }
        $vaccine_take->next_dose_number = $vaccine_take->completed_doses + 1;

        return view('admin_user.center.vaccine_registration_update',compact('vaccine_take','dose_date_details'));
    }

    public function VaccineRegistrationUpdatePost(Request $request){
        // Validation
        $request->validate([
            'id' => 'required',
            'next_dose_number' => 'required',
            'next_dose_date' => 'required|date|after_or_equal:next_dose_assigned_date',
            'next_dose_assigned_date' => 'required|date',
        ]);

        $vaccine_take = VaccineTake::findOrFail($request->id);
        if($vaccine_take->user->role == 'user'){

            //vaccine availability check
            $vaccine_stock_check = VaccineStock::where('vaccine_id',$vaccine_take->vaccine_id)->where('center_id',$vaccine_take->center_id)->first();
            if(!$vaccine_stock_check){
                $notification = array(
                    'message' => 'Vaccine is not available, Try again later',
                    'alert-type' => 'error',
                );
        
                return redirect('/center/dashboard')->with($notification);
            }else{
                if($vaccine_stock_check->available <= 0){
                    $notification = array(
                        'message' => 'Vaccine is not available, Try again later',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/center/dashboard')->with($notification);
                }else{
                   // Next dose date Update
                    $dose_date_details = json_decode($vaccine_take->dose_date_details);
                    if($dose_date_details){
                        //next dose date should be greater than the previous dose date
                        if($request->next_dose_number > 1 && $request->next_dose_date <= $dose_date_details[$request->next_dose_number-2]->dose_date){
                            $notification = array(
                                'message' => 'Next dose date should be greater than the previous dose date',
                                'alert-type' => 'error',
                            );
                    
                            return redirect('/center/dashboard')->with($notification);
                        }
                        for($i = 0; $i < $vaccine_take->vaccine->doses_required; $i++){
                            if($dose_date_details[$i]->dose_number == $request->next_dose_number){
                                $dose_date_details[$i]->dose_date = $request->next_dose_date;
                            }else if($dose_date_details[$i]->dose_number > $request->next_dose_number){
                                if($vaccine_take->vaccine->dose_gap_number !=null && $vaccine_take->vaccine->dose_gap_time !=null){
                                    $nextDoseDate = Carbon::parse($dose_date_details[$i-1]->dose_date);
                                    if($vaccine_take->vaccine->dose_gap_time == 'day'){
                                        $nextDoseDate->addDays($vaccine_take->vaccine->dose_gap_number)->format('Y-m-d');
                                    }else if($vaccine_take->vaccine->dose_gap_time == 'week'){
                                        $nextDoseDate->addWeeks($vaccine_take->vaccine->dose_gap_number)->format('Y-m-d');
                                    }else if($vaccine_take->vaccine->dose_gap_time == 'month'){
                                        $nextDoseDate->addMonths($vaccine_take->vaccine->dose_gap_number)->format('Y-m-d');
                                    }else if($vaccine_take->vaccine->dose_gap_time == 'year'){
                                        $nextDoseDate->addYears($vaccine_take->vaccine->dose_gap_number)->format('Y-m-d');
                                    }
                                    $dose_date_details[$i]->dose_date = $nextDoseDate->toDateString();
                                }
                            }
                        }
                    }
                    $vaccine_take->dose_date_details = json_encode($dose_date_details);
                    $vaccine_take->completed_doses = $vaccine_take->completed_doses + 1;
                    $vaccine_take->save();


                    // Vaccine Stock Update
                    $vaccine_stock_check->available = $vaccine_stock_check->available - 1;
                    $vaccine_stock_check->given = $vaccine_stock_check->given + 1;
                    $vaccine_stock_check->save();

                    //Mail
                    $mailData = [
                        'subject' => 'Vaccination Registration Successful',
                        'title' => 'Vaccine Management System',
                        'user_name' => $vaccine_take->user->username,
                        'vaccine' => $vaccine_take->vaccine->name,
                        'registration_date' => $vaccine_take->order_date,
                        'next_dose_date' => $vaccine_take->completed_doses >= $vaccine_take->vaccine->doses_required ? 'completed' : $dose_date_details[$request->next_dose_number]->dose_date,
                        'status' => $vaccine_take->completed_doses >= $vaccine_take->vaccine->doses_required ? 'Completed' : 'Pending',
                    ];

                    Mail::to($vaccine_take->user->email)->send(new SendMail($mailData));

                }
            }

        }else{
            //vaccine availability check
            $vaccine_stock_check = VaccineStock::where('vaccine_id',$vaccine_take->vaccine_id)->where('center_id',$vaccine_take->center_id)->first();
            if(!$vaccine_stock_check){
                $notification = array(
                    'message' => 'Vaccine is not available, Try again later',
                    'alert-type' => 'error',
                );
        
                return redirect('/center/dashboard')->with($notification);
            }else{
                if($vaccine_stock_check->reserved <= 0){
                    $notification = array(
                        'message' => 'Vaccine is not available, Try again later',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/center/dashboard')->with($notification);
                }else{
                   // Next dose date Update
                    $dose_date_details = json_decode($vaccine_take->dose_date_details);
                    if($dose_date_details){
                        //next dose date should be greater than the previous dose date
                        if($request->next_dose_number > 1 && $request->next_dose_date <= $dose_date_details[$request->next_dose_number-2]->dose_date){
                            $notification = array(
                                'message' => 'Next dose date should be greater than the previous dose date',
                                'alert-type' => 'error',
                            );
                    
                            return redirect('/center/dashboard')->with($notification);
                        }
                        for($i = 0; $i < $vaccine_take->vaccine->doses_required; $i++){
                            if($dose_date_details[$i]->dose_number == $request->next_dose_number){
                                $dose_date_details[$i]->dose_date = $request->next_dose_date;
                            }else if($dose_date_details[$i]->dose_number > $request->next_dose_number){
                                if($vaccine_take->vaccine->dose_gap_number !=null && $vaccine_take->vaccine->dose_gap_time !=null){
                                    $nextDoseDate = Carbon::parse($dose_date_details[$i-1]->dose_date);
                                    if($vaccine_take->vaccine->dose_gap_time == 'day'){
                                        $nextDoseDate->addDays($vaccine_take->vaccine->dose_gap_number)->format('Y-m-d');
                                    }else if($vaccine_take->vaccine->dose_gap_time == 'week'){
                                        $nextDoseDate->addWeeks($vaccine_take->vaccine->dose_gap_number)->format('Y-m-d');
                                    }else if($vaccine_take->vaccine->dose_gap_time == 'month'){
                                        $nextDoseDate->addMonths($vaccine_take->vaccine->dose_gap_number)->format('Y-m-d');
                                    }else if($vaccine_take->vaccine->dose_gap_time == 'year'){
                                        $nextDoseDate->addYears($vaccine_take->vaccine->dose_gap_number)->format('Y-m-d');
                                    }
                                    $dose_date_details[$i]->dose_date = $nextDoseDate->toDateString();
                                }
                            }
                        }
                    }
                    $vaccine_take->dose_date_details = json_encode($dose_date_details);
                    $vaccine_take->completed_doses = $vaccine_take->completed_doses + 1;
                    $vaccine_take->save();


                    // Vaccine Stock Update
                    $vaccine_stock_check->reserved = $vaccine_stock_check->reserved - 1;
                    $vaccine_stock_check->reserved_given = $vaccine_stock_check->reserved_given + 1;
                    $vaccine_stock_check->save();

                }
            }
        }


        $notification = array(
            'message' => 'Vaccine Registration Updated Successful',
            'alert-type' => 'success',
        );

        return redirect('/center/dashboard')->with($notification);

    }




    //////////// Center Wise Vaccine Stock Operation ////////////////

    public function VaccineStockList(){
        $user_id = Auth::user()->id;
        $center = Center::where('center_user_id',$user_id)->first();
        $vaccine_stocks = VaccineStock::where('center_id',$center->id)->get();
        foreach($vaccine_stocks as $vaccine_stock){
            $vaccine_stock->vaccine = $vaccine_stock->vaccine;
            $vaccine_stock->center = $vaccine_stock->center;
        }
        $vaccines = Vaccine::all();
        return view('admin_user.center.stock.stock_list',compact('vaccine_stocks','center','vaccines'));
    }

    public function VaccineStockAdd(Request $request){
        //validation
        $request->validate([
            'vaccine_id' => 'required',
            'center_id' => 'required',
            'new_stock' => ['required', 'integer', 'min:1'],
            'reserve_stock' => ['nullable', 'integer', 'min:0', 'lte:new_stock'],
        ]);


        $vaccine_stock = VaccineStock::where('vaccine_id',$request->vaccine_id)->where('center_id',$request->center_id)->first();
        if($vaccine_stock){
            $vaccine_stock->available = $vaccine_stock->available + ($request->new_stock - ($request->reserve_stock ?? 0));
            $vaccine_stock->reserved = $vaccine_stock->reserved + ($request->reserve_stock ?? 0);
            $vaccine_stock->quantity = $vaccine_stock->quantity + $request->new_stock;
            $vaccine_stock->save();
        }else{
            $new_vaccine_stock = new VaccineStock();
            $new_vaccine_stock->vaccine_id = $request->vaccine_id;
            $new_vaccine_stock->center_id = $request->center_id;
            $new_vaccine_stock->available = $request->new_stock - ($request->reserve_stock ?? 0);
            $new_vaccine_stock->reserved = $request->reserve_stock ?? 0;
            $new_vaccine_stock->quantity = $request->new_stock;
            $new_vaccine_stock->save();
        }

        $notification = array(
            'message' => 'Vaccine Stock Added Successfully',
            'alert-type' => 'success',
        );

        return redirect('/center/vaccine-stock/list')->with($notification);


    }







    // All Notification Message ///
    public function MessageList(){
        $user_id = Auth::user()->id;
        $messages = Notification::where('user_id',$user_id)->where('type','message')->orderBy('status', 'desc')->orderBy('created_at', 'desc')->get();
        foreach($messages as $message){
            $message->fromUser = User::Where('email',$message->email)->first();
            $message->deliver_time = Carbon::parse($message->created_at)->diffForHumans();

        }
        return view('admin_user.center.message_list',compact('messages'));
    }





    
}
