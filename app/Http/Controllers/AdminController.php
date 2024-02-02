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
use App\Models\VaccineStock;

class AdminController extends Controller
{
    //

    public function index(){
        $user_id = Auth::user()->id;
        $app_users = User::whereNot('id',$user_id)->get();

        $total_user_number = $app_users->where('role', 'user')->count();
        $taking_vaccination_user_number = VaccineTake::where('completed_doses', '>' , 0)->whereNotNull('patient_nid')->distinct('patient_nid')->count();
        $top_vaccine = VaccineTake::select('vaccine_id')->groupBy('vaccine_id')->orderByRaw('COUNT(*) DESC')->first();
        $top_vaccine = $top_vaccine->vaccine->name ?? 'No Vaccine';
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
        // Retrieve the user's role from the database
        $user = User::findOrFail($request->id);
        $userRole = $user->role; // Adjust this based on your actual attribute name
    
        // Apply validation rules based on the user's role
        $request->validate([
            'id' => 'required',
            'username' => 'required|min:4|unique:users,username,'.$request->id,
            'email' => 'required|min:6|unique:users,email,'.$request->id,
            'password' => ['nullable', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'dob' => ($userRole === 'center') ? 'nullable|date' : 'required|date',
            'phone' => 'required|min:10',
        ]);
    
        // Update user information
        $user->username = $request->username;
        $user->email = $request->email;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
    
        if($request->dob){
            $user->dob = $request->dob;
        }
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
    
        $notification = [
            'message' => 'User Info Updated Successfully',
            'alert-type' => 'success',
        ];
    
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
            $vaccine->available_quantity = $vaccine->vaccine_stocks->sum(function ($stock) {
                return $stock->available + $stock->reserved;
            });
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
        

        // has vaccine take history check
        $vaccine_take_histories = VaccineTake::where('vaccine_id',$id)->get();
        if($vaccine_take_histories && $vaccine_take_histories->count() > 0){
            $notification = array(
                'message' => 'Vaccine has Vaccination history. Delete the Vaccination history first',
                'alert-type' => 'error',
            );
    
            return redirect('/admin/disease-info/'.$disease_id)->with($notification);
        }

        // Delete Vaccine
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
            $vaccine->available_quantity = $vaccine->vaccine_stocks->sum(function ($stock) {
                                            return $stock->available + $stock->reserved;
                                        });
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
        

        // has vaccine take history check
        $vaccine_take_histories = VaccineTake::where('vaccine_id',$id)->get();
        if($vaccine_take_histories && $vaccine_take_histories->count() > 0){
            $notification = array(
                'message' => 'Vaccine has Vaccination history. Delete the Vaccination history first',
                'alert-type' => 'error',
            );
    
            return redirect('/admin/vaccine_list')->with($notification);
        }


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
            'email' => 'required|unique:users,email|min:6',
            'phone' => 'required',
            'newPassword' => ['required', Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised(), 'same:reNewPassword'],
            'reNewPassword' => 'required|min:8'
        ]);

        $center = new Center();

        $center->hospital = $request->hospital;
        $center->division = $request->division;
        $center->address = $request->address;
        $center->location_link = $request->location_link;
        $center->phone = $request->phone;
        $center->email = $request->email;
        $center->save();


        // Center User Creation
        $user = new User();
        $user->username = $request->hospital;
        $user->email = $request->email;
        $user->password = Hash::make($request->newPassword);
        $user->role = 'center';
        $user->status = 'active';
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();

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



    //////////// Center Wise Vaccine Stock Operation ////////////////

    public function VaccineStockList($center_id){
        $center = Center::findOrFail($center_id);
        $vaccine_stocks = VaccineStock::where('center_id',$center_id)->get();
        foreach($vaccine_stocks as $vaccine_stock){
            $vaccine_stock->vaccine = $vaccine_stock->vaccine;
            $vaccine_stock->center = $vaccine_stock->center;
        }
        $vaccines = Vaccine::all();
        return view('admin_user.admin.center.stock.stock_list',compact('vaccine_stocks','center','vaccines'));
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

        return redirect('/admin/vaccine-stock/list/'.$request->center_id)->with($notification);


    }





    //////// Vaccination Status Operation ////////////////
    public function VaccinationStatusList(){
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

        $vaccine_takes = VaccineTake::orderBy('order_date', 'desc')->get();
        foreach($vaccine_takes as $vaccine_take){
            $vaccine_take->user = $vaccine_take->user;
            $vaccine_take->vaccine = $vaccine_take->vaccine;
            $vaccine_take->center = $vaccine_take->center;
            $dose_date_details = json_decode($vaccine_take->dose_date_details);
            $vaccine_take->first_dose_date = $dose_date_details[0]->dose_date;
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
    
            return redirect('/admin/vaccination-status_list')->with($notification);
        }else{
            if($vaccine_stock_check->available <= 0){
                $notification = array(
                    'message' => 'Vaccine is not available, Try again later',
                    'alert-type' => 'error',
                );
        
                return redirect('/admin/vaccination-status_list')->with($notification);
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
            
                    return redirect('/admin/vaccination-status_list')->with($notification);
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
            
                    return redirect('/admin/vaccination-status_list')->with($notification);
                }


                if(($vaccine_take_history->vaccine->doses_required - $vaccine_take_history->completed_doses) > 0){
                    $dose_date_details = json_decode($vaccine_take_history->dose_date_details);
                    $last_dose_date = $dose_date_details[($vaccine_take_history->vaccine->doses_required - 1)]->dose_date;
                    if($last_dose_date >= Carbon::now()->format('Y-m-d')){
                        $notification = array(
                            'message' => 'User is not eligible for this vaccine yet',
                            'alert-type' => 'error',
                        );
                
                        return redirect('/admin/vaccination-status_list')->with($notification);
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

        return redirect('/admin/vaccination-status_list')->with($notification);

    }


    public function UnderprivilegedVaccineRegistrationView(){
        $vaccines = Vaccine::all();
        return view('admin_user.admin.underprivilegedRegistration.vaccine_registration',compact('vaccines'));
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
    
            return redirect('/admin/vaccination-status_list')->with($notification);
        }else{
            if($vaccine_stock_check->reserved <= 0){
                $notification = array(
                    'message' => 'Vaccine is not available, Try again later',
                    'alert-type' => 'error',
                );
        
                return redirect('/admin/vaccination-status_list')->with($notification);
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
            
                    return redirect('/admin/vaccination-status_list')->with($notification);
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
            
                    return redirect('/admin/vaccination-status_list')->with($notification);
                }


                if(($vaccine_take_history->vaccine->doses_required - $vaccine_take_history->completed_doses) > 0){
                    $dose_date_details = json_decode($vaccine_take_history->dose_date_details);
                    $last_dose_date = $dose_date_details[($vaccine_take_history->vaccine->doses_required - 1)]->dose_date;
                    if($last_dose_date >= Carbon::now()->format('Y-m-d')){
                        $notification = array(
                            'message' => 'User is not eligible for this vaccine yet',
                            'alert-type' => 'error',
                        );
                
                        return redirect('/admin/vaccination-status_list')->with($notification);
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

        return redirect('/admin/vaccination-status_list')->with($notification);

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

        return view('admin_user.admin.vaccine_registration_update',compact('vaccine_take','dose_date_details'));
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
        
                return redirect('/admin/vaccination-status_list')->with($notification);
            }else{
                if($vaccine_stock_check->available <= 0){
                    $notification = array(
                        'message' => 'Vaccine is not available, Try again later',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/admin/vaccination-status_list')->with($notification);
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
                    
                            return redirect('/admin/vaccination-status_list')->with($notification);
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
        
                return redirect('/admin/vaccination-status_list')->with($notification);
            }else{
                if($vaccine_stock_check->reserved <= 0){
                    $notification = array(
                        'message' => 'Vaccine is not available, Try again later',
                        'alert-type' => 'error',
                    );
            
                    return redirect('/admin/vaccination-status_list')->with($notification);
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
                    
                            return redirect('/admin/vaccination-status_list')->with($notification);
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

        return redirect('/admin/vaccination-status_list')->with($notification);

    }







    public function VaccinationStatusVaccine($id){
        $vaccine = Vaccine::findOrFail($id);
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

        $vaccine_takes = VaccineTake::where('vaccine_id',$vaccine->id)->get();
        foreach($vaccine_takes as $vaccine_take){
            $vaccine_take->user = $vaccine_take->user;
            $vaccine_take->vaccine = $vaccine_take->vaccine;
            $vaccine_take->center = $vaccine_take->center;
            $dose_date_details = json_decode($vaccine_take->dose_date_details);
            $vaccine_take->first_dose_date = $dose_date_details[0]->dose_date;
        }
        return view('admin_user.admin.vaccination_status_vaccine',compact('vaccine','vaccine_takes'));
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

        return view('admin_user.admin.vaccination_details',compact('vaccine_take','dose_date_details'));
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
