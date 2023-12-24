<?php

namespace App\Http\Controllers;

use App\Mail\AdminSendMail;
use App\Models\Center;
use App\Models\Disease;
use App\Models\User;
use App\Models\Vaccine;
use App\Models\VaccineTake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use stdClass;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Notification;

class AdminController extends Controller
{
    //

    public function index(){
        $user_id = Auth::user()->id;
        $app_users = User::whereNot('id',$user_id)->get();

        $total_user_number = $app_users->where('role', 'user')->count();
        $taking_vaccination_user_number = VaccineTake::whereNotNull('user_id')->distinct('user_id')->count();
        $top_vaccine = VaccineTake::select('vaccine_id')->groupBy('vaccine_id')->orderByRaw('COUNT(*) DESC')->first();
        $top_vaccine = $top_vaccine->vaccine->name;
        $total_vaccine = Vaccine::all()->count();


        return view('admin_user.admin.index',compact('app_users','total_user_number','taking_vaccination_user_number','top_vaccine','total_vaccine'));
    }



    public function AdminProfileInfo(){
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        return view('admin_user.admin.admin_profile_view', compact('userData'));

    }

    public function AdminProfileUpdate(Request $request){
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
        $userData->phone = $request->phone;
        $userData->dob = $request->dob;
        $userData->address = $request->address;

        if($request->hasfile('photo')){
            $destination = 'upload/admin_images/'.$userData->photo;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $userData['photo'] = $filename;
        }
        $userData->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword(){
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        return view('admin_user.admin.admin_change_password', compact('userData'));

    }

    public function AdminPasswordUpdate(Request $request){
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


    public function AppUserCreateView(){
        return view('admin_user.admin.appUser_create');
    }


    public function AppUserCreatePost(Request $request){
        // Validation
        $request->validate([
            // 'name' => 'required',
            'username' => 'required|unique:users,username|min:4',
            'email' => 'required|unique:users,email|min:6',
            'password' => ['required', Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised()],
            'dob' => 'required|date',
            'phone' => 'required|min:10',
        ]);

        $user = new User();
        // $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        $notification = array(
            'message' => 'New User Created Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/dashboard')->with($notification);


    }

    public function AppUserEditView($id){
        $app_user = User::findOrFail($id);
        return view('admin_user.admin.appUser_edit',compact('app_user'));
    }

    public function AppUserEditPost(Request $request){
        $request->validate([
            'id' => 'required',
            // 'name' => 'required',
            'username' => 'required|min:4|unique:users,username,'.$request->id,
            'email' => 'required|min:6|unique:users,email,'.$request->id,
            'password' => ['nullable', Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised()],
            'dob' => 'required|date',
            'phone' => 'required|min:10',
        ]);

        $user = User::findOrFail($request->id);
        // $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        $notification = array(
            'message' => 'User Info Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/dashboard')->with($notification);
    }

    public function AppUserStatusUpdate($id, $status){
        $app_user = User::findOrFail($id);
        if($status === 'active'){
            $app_user->status = 'active';
        }else if($status === 'inactive'){
            $app_user->status = 'inactive';
        }
        $app_user->save();

        return back();
    }

    //////// Diseases Operation ////////////////

    public function DiseaseList(){
        $diseases = Disease::all();
        return view('admin_user.admin.disease_list',compact('diseases'));
    }

    public function DiseaseCreateView(){
        return view('admin_user.admin.disease_create');
    }


    public function DiseaseCreatePost(Request $request){
        // Validation
        $request->validate([
            'name' => 'required|unique:diseases,name|min:3',
        ]);

        $disease = new Disease();

        $disease->name = $request->name;
        $disease->symptoms = $request->symptoms;
        $disease->prevention = $request->prevention;
        $disease->treatment = $request->treatment;
        $disease->description = $request->description;
        $disease->save();

        $notification = array(
            'message' => 'New Disease Added Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/disease_list')->with($notification);

    }

    public function DiseaseEditView($id){
        $disease = Disease::findOrFail($id);
        return view('admin_user.admin.disease_edit',compact('disease'));
    }

    public function DiseaseEditPost(Request $request){
        $request->validate([
            'id' => 'required',
            'name' => 'required|min:4|unique:diseases,name,'.$request->id,
        ]);

        $disease = Disease::findOrFail($request->id);
        
        $disease->name = $request->name;

        if($request->symptoms){
            $disease->symptoms = $request->symptoms;
        }
        
        if($request->prevention){
            $disease->prevention = $request->prevention;
        }

        if($request->treatment){
            $disease->treatment = $request->treatment;
        }

        if($request->description){
            $disease->description = $request->description;
        }
        $disease->save();

        $notification = array(
            'message' => 'Disease Info Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/disease_list')->with($notification);
    }

    public function DiseaseDelete($id){
        $disease = Disease::findOrFail($id);
        if($disease->vaccines->count() > 0){
            $notification = array(
                'message' => 'Disease has vaccines. Delete the vaccines first',
                'alert-type' => 'error',
            );
    
            return redirect('/admin/disease_list')->with($notification);
        }
        $disease->delete();

        $notification = array(
            'message' => 'Disease Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/disease_list')->with($notification);
    }

    public function Diseaseinfo($id){
        $disease = Disease::findOrFail($id);
        $vaccines = $disease->vaccines;
        foreach($vaccines as $vaccine){
            $vaccine->available_quantity = $vaccine->stock_quantity - $vaccine->vaccine_takes->sum('completed_doses');
            $vaccine->booked_quantity = $vaccine->vaccine_takes->sum(function ($vaccineTake) use ($vaccine) {
                                            return $vaccine->doses_required - $vaccineTake->completed_doses;
                                        });
            $vaccine->given_quantity = $vaccine->vaccine_takes->sum('completed_doses');
        }
        return view('admin_user.admin.disease_info',compact('disease','vaccines'));
    }

    public function DiseaseVaccineCreateView($disease_id){
        $disease = Disease::findOrFail($disease_id);
        return view('admin_user.admin.disease_vaccine_create',compact('disease'));
    }


    public function DiseaseVaccineCreatePost(Request $request){
        // Validation
        $request->validate([
            'name' => 'required|unique:vaccines,name|min:3',
            'disease_id' => 'required',
            'stock_quantity' => ['integer', 'min:0'],
            'doses_required' => ['integer', 'min:1'],
            'dose_gap_number' => ['nullable','integer', 'min:0', Rule::requiredIf(request('doses_required') > 1)],
            'dose_gap_time' => [Rule::requiredIf(request('doses_required') > 1)],
        ]);

        $vaccine = new Vaccine();

        $vaccine->name = $request->name;
        $vaccine->disease_id = $request->disease_id;
        $vaccine->description = $request->description;
        $vaccine->manufacturer = $request->manufacturer;
        $vaccine->doses_required = $request->doses_required;
        $vaccine->stock_quantity = $request->stock_quantity;
        $vaccine->dose_gap_number = $request->dose_gap_number;
        $vaccine->dose_gap_time = $request->dose_gap_time;
        $vaccine->save();

        $notification = array(
            'message' => 'New Vaccine Added Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/disease-info/'.$request->disease_id)->with($notification);

    }

    public function DiseaseVaccineEditView($id, $disease_id){
        $vaccine = Vaccine::findOrFail($id);
        $disease = Disease::findOrFail($disease_id);
        return view('admin_user.admin.disease_vaccine_edit',compact('vaccine','disease'));
    }


    public function DiseaseVaccineEditPost(Request $request){
        // Validation
        $request->validate([
            'name' => 'required|min:3|unique:vaccines,name,'.$request->id,
            'disease_id' => 'required',
            'stock_quantity' => ['integer', 'min:0'],
            'doses_required' => ['integer', 'min:1'],
            'dose_gap_number' => ['nullable','integer', 'min:0', Rule::requiredIf(request('doses_required') > 1)],
            'dose_gap_time' => [Rule::requiredIf(request('doses_required') > 1)],
        ]);

        $vaccine = Vaccine::findOrFail($request->id);

        $vaccine->name = $request->name;
        $vaccine->disease_id = $request->disease_id;
        $vaccine->description = $request->description;
        $vaccine->manufacturer = $request->manufacturer;
        $vaccine->doses_required = $request->doses_required;
        $vaccine->stock_quantity = $request->stock_quantity;
        $vaccine->dose_gap_number = $request->dose_gap_number;
        $vaccine->dose_gap_time = $request->dose_gap_time;
        $vaccine->save();

        $notification = array(
            'message' => 'Vaccine Info Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/disease-info/'.$request->disease_id)->with($notification);

    }

    public function DiseaseVaccineDelete($id){
        $vaccine = Vaccine::findOrFail($id);
        $disease_id = $vaccine->disease_id;
        $vaccine->delete();

        $notification = array(
            'message' => 'Vaccine Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/disease-info/'.$disease_id)->with($notification);
    }






    //////// Vaccines Operation ////////////////

    public function VaccineList(){
        $vaccines = Vaccine::all();
        foreach($vaccines as $vaccine){
            $vaccine->available_quantity = $vaccine->stock_quantity - $vaccine->vaccine_takes->sum('completed_doses');
            $vaccine->booked_quantity = $vaccine->vaccine_takes->sum(function ($vaccineTake) use ($vaccine) {
                                            return $vaccine->doses_required - $vaccineTake->completed_doses;
                                        });
            $vaccine->given_quantity = $vaccine->vaccine_takes->sum('completed_doses');
            $vaccine->disease_name = $vaccine->disease->name;
        }
        return view('admin_user.admin.vaccine_list',compact('vaccines'));
    }

    public function VaccineCreateView(){
        $diseases = Disease::all();
        return view('admin_user.admin.vaccine_create',compact('diseases'));
    }

    public function VaccineCreatePost(Request $request){
        // Validation
        $request->validate([
            'name' => 'required|unique:vaccines,name|min:3',
            'disease_id' => 'required',
            'stock_quantity' => ['integer', 'min:0'],
            'doses_required' => ['integer', 'min:1'],
            'dose_gap_number' => ['nullable','integer', 'min:0', Rule::requiredIf(request('doses_required') > 1)],
            'dose_gap_time' => [Rule::requiredIf(request('doses_required') > 1)],
        ]);

        $vaccine = new Vaccine();

        $vaccine->name = $request->name;
        $vaccine->disease_id = $request->disease_id;
        $vaccine->description = $request->description;
        $vaccine->manufacturer = $request->manufacturer;
        $vaccine->doses_required = $request->doses_required;
        $vaccine->stock_quantity = $request->stock_quantity;
        $vaccine->dose_gap_number = $request->dose_gap_number;
        $vaccine->dose_gap_time = $request->dose_gap_time;
        $vaccine->save();

        $notification = array(
            'message' => 'New Vaccine Added Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/vaccine_list')->with($notification);

    }


    public function VaccineEditView($id){
        $vaccine = Vaccine::findOrFail($id);
        $diseases = Disease::all();
        return view('admin_user.admin.vaccine_edit',compact('vaccine','diseases'));
    }

    public function VaccineEditPost(Request $request){
        // Validation
        $request->validate([
            'name' => 'required|min:3|unique:vaccines,name,'.$request->id,
            'disease_id' => 'required',
            'stock_quantity' => ['integer', 'min:0'],
            'doses_required' => ['integer', 'min:1'],
            'dose_gap_number' => ['nullable','integer', 'min:0', Rule::requiredIf(request('doses_required') > 1)],
            'dose_gap_time' => [Rule::requiredIf(request('doses_required') > 1)],
        ]);

        $vaccine = Vaccine::findOrFail($request->id);

        $vaccine->name = $request->name;
        $vaccine->disease_id = $request->disease_id;
        $vaccine->description = $request->description;
        $vaccine->manufacturer = $request->manufacturer;
        $vaccine->doses_required = $request->doses_required;
        $vaccine->stock_quantity = $request->stock_quantity;
        $vaccine->dose_gap_number = $request->dose_gap_number;
        $vaccine->dose_gap_time = $request->dose_gap_time;
        $vaccine->save();

        $notification = array(
            'message' => 'Vaccine Info Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/vaccine_list')->with($notification);

    }

    public function VaccineDelete($id){
        $vaccine = Vaccine::findOrFail($id);
        $vaccine->delete();

        $notification = array(
            'message' => 'Vaccine Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/vaccine_list')->with($notification);
    }




    //////////// Center Operation ////////////////

    public function CenterList($division){
        $centers = Center::where('division',$division)->get();
        return view('admin_user.admin.center.center_list',compact('centers','division'));
    }


    public function CenterCreateView(){
        return view('admin_user.admin.center.center_create');
    }

    public function CenterCreatePost(Request $request){
        // Validation
        $request->validate([
            'hospital' => 'required|unique:centers,hospital|min:3',
            'division' => 'required',
            'address' => 'required',
            'location_link' => 'required',
            'phone' => 'required',
        ]);

        $center = new Center();

        $center->hospital = $request->hospital;
        $center->division = $request->division;
        $center->address = $request->address;
        $center->location_link = $request->location_link;
        $center->phone = $request->phone;
        $center->email = $request->email;
        $center->save();

        $notification = array(
            'message' => 'New Center Added Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/center_list/Dhaka')->with($notification);

    }

    public function CenterEditView($id){
        $center = Center::findOrFail($id);
        return view('admin_user.admin.center.center_edit',compact('center'));
    }

    public function CenterEditPost(Request $request){
        // Validation
        $request->validate([
            'id' => 'required',
            'hospital' => 'required|min:3|unique:centers,hospital,'.$request->id,
            'division' => 'required',
            'address' => 'required',
            'location_link' => 'required',
            'phone' => 'required',
        ]);

        $center = Center::findOrFail($request->id);

        $center->hospital = $request->hospital;
        $center->division = $request->division;
        $center->address = $request->address;
        $center->location_link = $request->location_link;
        $center->phone = $request->phone;
        $center->email = $request->email;
        $center->save();

        $notification = array(
            'message' => 'Center Info Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/center_list/Dhaka')->with($notification);

    }

    public function CenterDelete($id){
        $center = Center::findOrFail($id);
        $center->delete();

        $notification = array(
            'message' => 'Center Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/center_list/Dhaka')->with($notification);
    }





    //////// Vaccination Status Operation ////////////////
    public function VaccinationStatusList(){
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

        $vaccine_takes = VaccineTake::orderBy('order_date', 'desc')->get();
        foreach($vaccine_takes as $vaccine_take){
            $vaccine_take->user = $vaccine_take->user;
            $vaccine_take->vaccine = $vaccine_take->vaccine;
            $vaccine_take->center = $vaccine_take->center;
        }
        return view('admin_user.admin.vaccination_status_list',compact('vaccines','vaccine_takes'));
    } 
    
    

    public function VaccineRegistrationView(){
        $users = User::all();
        $vaccines = Vaccine::all();
        return view('admin_user.admin.vaccine_registration',compact('vaccines','users'));
    }

    public function VaccineRegistrationPost(Request $request){
        // Validation
        $request->validate([
            'user_id' => 'required',
            'vaccine_id' => 'required',
            'division' => 'required',
        ]);

        $vaccine = Vaccine::findOrFail($request->vaccine_id);
        $vaccine->available_quantity = $vaccine->stock_quantity - $vaccine->vaccine_takes->sum('completed_doses');
        if($vaccine->available_quantity <= 0){
            $notification = array(
                'message' => 'Vaccine is not available, Try again later',
                'alert-type' => 'error',
            );
    
            return redirect('/admin/vaccination-status_list')->with($notification);
        }

        $vaccine_take_histories = VaccineTake::where('user_id',$request->user_id)->get();
        if($vaccine_take_histories->count() > 0){

            foreach($vaccine_take_histories as $vaccine_take_history){
                if($vaccine_take_history->vaccine_id == $request->vaccine_id){
                    $notification = array(
                        'message' => 'User already registered for this vaccine',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/admin/vaccination-status_list')->with($notification);
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
            
                    return redirect('/admin/vaccination-status_list')->with($notification);
                }
            }else if($vaccine_take_history->vaccine->doses_required <= 1 && Carbon::parse($vaccine_take_history->first_dose_date)->format('Y-m-d') > Carbon::now()->format('Y-m-d')){
                $notification = array(
                    'message' => 'User is not eligible for this vaccine yet',
                    'alert-type' => 'error',
                );
        
                return redirect('/admin/vaccination-status_list')->with($notification);
            }
        }

        $center = Center::where('division',$request->division)->first();

        $vaccine_take = new VaccineTake();

        $vaccine_take->user_id = $request->user_id;
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

        return redirect('/admin/vaccination-status_list')->with($notification);

    }



    public function VaccineRegistrationUpdateView($id){
        $vaccine_take = VaccineTake::findOrFail($id);
        $users = User::all();
        $vaccines = Vaccine::all();
        return view('admin_user.admin.vaccine_registration_update',compact('vaccine_take','users','vaccines'));
    }

    public function VaccineRegistrationUpdatePost(Request $request){
        // Validation
        $request->validate([
            'id' => 'required',
            'vaccine_id' => 'required',
            'division' => 'required',
            'first_dose_date' => 'required',
            'completed_doses' => 'required',
        ]);

        $vaccine_take = VaccineTake::findOrFail($request->id);

        $vaccine = Vaccine::findOrFail($request->vaccine_id);
        if($vaccine_take->vaccine_id != $request->vaccine_id){
            $vaccine->available_quantity = $vaccine->stock_quantity - $vaccine->vaccine_takes->sum('completed_doses');
            if($vaccine->available_quantity <= 0){
                $notification = array(
                    'message' => 'Vaccine is not available, Try again later',
                    'alert-type' => 'error',
                );
                return redirect('/admin/vaccination-status_list')->with($notification);
            }


            $vaccine_take_histories = VaccineTake::whereNot('id',$vaccine_take->id)->where('user_id',$request->user_id)->get();
            if($vaccine_take_histories->count() > 0){

                foreach($vaccine_take_histories as $vaccine_take_history){
                    if($vaccine_take_history->vaccine_id == $request->vaccine_id){
                        $notification = array(
                            'message' => 'User already registered for this vaccine',
                            'alert-type' => 'error',
                        );
                
                        return redirect('/admin/vaccination-status_list')->with($notification);
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
                
                        return redirect('/admin/vaccination-status_list')->with($notification);
                    }
                }else if($vaccine_take_history->vaccine->doses_required <= 1 && Carbon::parse($vaccine_take_history->first_dose_date)->format('Y-m-d') > Carbon::now()->format('Y-m-d')){
                    $notification = array(
                        'message' => 'User is not eligible for this vaccine yet',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/admin/vaccination-status_list')->with($notification);
                }
            }


        }


        if($vaccine_take->division != $request->division){
            $vaccine_take->division = $request->division;
            $center = Center::where('division',$request->division)->first();
            $vaccine_take->center_id = $center->id;
        }

        $vaccine_take->vaccine_id = $request->vaccine_id;

        if($vaccine_take->first_dose_date <= $request->first_dose_date && $request->first_dose_date > Carbon::now()->format('Y-m-d')){
            $vaccine_take->first_dose_date = $request->first_dose_date;
        }else{
            $notification = array(
                'message' => 'First dose date can not be less than previous date or current date',
                'alert-type' => 'error',
            );
    
            return redirect('/admin/vaccination-status_list')->with($notification);
        }
        //$vaccine_take->first_dose_date = Carbon::parse($vaccine_take->order_date)->addDays(14)->toDateString();  // 14 days after order date

        if($request->completed_doses <= $vaccine_take->vaccine->doses_required){
            $vaccine_take->completed_doses = $request->completed_doses;
        }else{
            $notification = array(
                'message' => 'Completed doses can not be greater than required doses',
                'alert-type' => 'error',
            );
    
            return redirect('/admin/vaccination-status_list')->with($notification);
        }
        $vaccine_take->save();

        $notification = array(
            'message' => 'Vaccine Registration Updated Successful',
            'alert-type' => 'success',
        );

        return redirect('/admin/vaccination-status_list')->with($notification);

    }







    public function VaccinationStatusVaccine($id){
        $vaccine = Vaccine::findOrFail($id);
        $vaccine->available_quantity = $vaccine->stock_quantity - $vaccine->vaccine_takes->sum('completed_doses');
        $vaccine->booked_quantity = $vaccine->vaccine_takes->sum(function ($vaccineTake) use ($vaccine) {
                                        return $vaccine->doses_required - $vaccineTake->completed_doses;
                                    });
        $vaccine->given_quantity = $vaccine->vaccine_takes->sum('completed_doses');
        $vaccine->disease_name = $vaccine->disease->name;

        $vaccine_taken = VaccineTake::where('vaccine_id',$vaccine->id)->sum('completed_doses');
        $vaccine->vaccine_taken_percent = $vaccine->stock_quentity <= 0 ? 0 : ($vaccine_taken / $vaccine->stock_quantity) * 100;

        $vaccine_takes = VaccineTake::where('vaccine_id',$vaccine->id)->get();
        foreach($vaccine_takes as $vaccine_take){
            $vaccine_take->user = $vaccine_take->user;
            $vaccine_take->vaccine = $vaccine_take->vaccine;
            $vaccine_take->center = $vaccine_take->center;
        }
        return view('admin_user.admin.vaccination_status_vaccine',compact('vaccine','vaccine_takes'));
    }


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

        return view('admin_user.admin.vaccination_details',compact('vaccine_take','vaccine_doses'));
    }



    // All Notification Message ///
    public function MessageList(){
        $user_id = Auth::user()->id;
        $messages = Notification::where('user_id',$user_id)->where('type','message')->orderBy('status', 'desc')->orderBy('created_at', 'desc')->get();
        foreach($messages as $message){
            $message->fromUser = User::Where('email',$message->email)->first();
            $message->deliver_time = Carbon::parse($message->created_at)->diffForHumans();

        }
        return view('admin_user.admin.message_list',compact('messages'));
    }



    ///////Send Mail/////////

    public function SendMail(){
        $mailData = [
            'subject' => 'Bujhonai Beparta',
            'title' => 'Mail From Vaccine Registration System',
            'body' => 'This is for testing email using smtp'
        ];

        Mail::to('evansarwer1@gmail.com')->send(new SendMail($mailData));

        dd("Mail Send Successfully");
    }

    public function SendMailNotificationView($email = null){
        return view('admin_user.admin.sendMailNotification',compact('email'));
    }

    public function SendMailNotificationPost(Request $request){
        $request->validate([
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $user = User::where('email',$request->email)->first();
        if($user){
            $notification = new Notification();
            $notification->user_id = $user->id;
            $notification->email = Auth::user()->email;
            $notification->message = $request->message;
            $notification->type = 'message';
            $notification->status = 'unseen';
            $notification->created_at = date('Y-m-d H:i:s');
            $notification->save();
            
        }

        $mailData = [
            'subject' => $request->subject,
            'title' => $request->subject,
            'user_info' => $user ? $user->username : null,
            'message' => $request->message
        ];

        Mail::to($request->email)->send(new AdminSendMail($mailData));

        $notification = array(
            'message' => 'Mail Send Successfully',
            'alert-type' => 'success',
        );

        return redirect('/admin/message/list')->with($notification);
    }




}
