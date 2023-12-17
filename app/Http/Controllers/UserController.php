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
            'phone' => 'required|min:11',
            'address' => 'required',
        ]);

        $userData = User::find($user_id);
        $userData->username = $request->username;
        $userData->email = $request->email;
        $userData->phone = $request->phone;
        $userData->address = $request->address;

        if($request->hasfile('photo')){
            $destination = 'upload/user_images/'.$userData->photo;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
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

        return view('admin_user.user.vaccination_details',compact('vaccine_take','vaccine_doses'));
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
        ]);

        $user_id = Auth::user()->id;

        $vaccine = Vaccine::findOrFail($request->vaccine_id);
        $vaccine->available_quantity = $vaccine->stock_quantity - $vaccine->vaccine_takes->sum('completed_doses');
        if($vaccine->available_quantity <= 0){
            $notification = array(
                'message' => 'Vaccine is not available, Try again later',
                'alert-type' => 'error',
            );
    
            return redirect('/user/dashboard')->with($notification);
        }

        $vaccine_take_histories = VaccineTake::where('user_id',$user_id)->get();
        if($vaccine_take_histories->count() > 0){

            foreach($vaccine_take_histories as $vaccine_take_history){
                if($vaccine_take_history->vaccine_id == $request->vaccine_id){
                    $notification = array(
                        'message' => 'User already registered for this vaccine',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/user/dashboard')->with($notification);
                }
            }

            if($vaccine_take_history->vaccine->dose_gap_number != null && $vaccine_take_history->vaccine->dose_gap_time != null){
                $dose_gap_number = $vaccine_take_history->vaccine->dose_gap_number;
                $dose_gap_time = $vaccine_take_history->vaccine->dose_gap_time;
                $first_dose_date = $vaccine_take_history->first_dose_date;

                if($dose_gap_time == 'day'){
                    $last_dose_date = Carbon::parse($first_dose_date)->addDays(($vaccine_take_history->vaccine->doses_required - 1) * $dose_gap_number)->format('Y-m-d');
                }else if($dose_gap_time == 'week'){
                    $last_dose_date = Carbon::parse($first_dose_date)->addWeeks(($vaccine_take_history->vaccine->doses_required - 1) * $dose_gap_number)->format('Y-m-d');
                }else if($dose_gap_time == 'month'){
                    $last_dose_date = Carbon::parse($first_dose_date)->addMonths(($vaccine_take_history->vaccine->doses_required - 1) * $dose_gap_number)->format('Y-m-d');
                }else if($dose_gap_time == 'year'){
                    $last_dose_date = Carbon::parse($first_dose_date)->addYears(($vaccine_take_history->vaccine->doses_required - 1) * $dose_gap_number)->format('Y-m-d');
                }

                $current_date = Carbon::now()->format('Y-m-d');

                if($current_date < $last_dose_date){
                    $notification = array(
                        'message' => 'User is not eligible for this vaccine yet',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/user/dashboard')->with($notification);
                }
            }else if($vaccine_take_history->vaccine->doses_required <= 1 && Carbon::parse($vaccine_take_history->first_dose_date)->format('Y-m-d') > Carbon::now()->format('Y-m-d')){
                $notification = array(
                    'message' => 'User is not eligible for this vaccine yet',
                    'alert-type' => 'error',
                );
        
                return redirect('/user/dashboard')->with($notification);
            }
        }

        $center = Center::where('division',$request->division)->first();

        $vaccine_take = new VaccineTake();

        $vaccine_take->user_id = $user_id;
        $vaccine_take->vaccine_id = $request->vaccine_id;
        $vaccine_take->division = $request->division;
        $vaccine_take->center_id = $center->id;
        $vaccine_take->order_date = Carbon::now()->format('Y-m-d');
        $vaccine_take->first_dose_date = Carbon::parse($vaccine_take->order_date)->addDays(14)->toDateString();  // 14 days after order date
        $vaccine_take->save();

        $mailData = [
            'subject' => 'Vaccination Registration Successful',
            'title' => 'Vaccine Management System',
            'user_name' => $vaccine_take->user->username,
            'vaccine' => $vaccine_take->vaccine->name,
            'registration_date' => $vaccine_take->order_date,
            'first_dose_date' => $vaccine_take->first_dose_date,
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
            $vaccine->available_quantity = $vaccine->stock_quantity - $vaccine->vaccine_takes->sum('completed_doses');
            $vaccine->booked_quantity = $vaccine->vaccine_takes->sum(function ($vaccineTake) use ($vaccine) {
                                            return $vaccine->doses_required - $vaccineTake->completed_doses;
                                        });
            $vaccine->given_quantity = $vaccine->vaccine_takes->sum('completed_doses');
            $vaccine->disease_name = $vaccine->disease->name;

            $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->sum('completed_doses');
            $vaccine->vaccine_taken_percent = $vaccine->stock_quentity <= 0 ? 0 : ($vaccine_taken / $vaccine->stock_quantity) * 100;
            
        }
        return view('admin_user.user.vaccine_list',compact('vaccines'));
    }


    public function VaccineWiseRegistrationView($id){
        $vaccine = Vaccine::findOrFail($id);
        return view('admin_user.user.vaccineWise_registration',compact('vaccine'));
    }





}
