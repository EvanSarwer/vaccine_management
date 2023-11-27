<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\User;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    //

    public function index(){
        $user_id = Auth::user()->id;
        $app_users = User::whereNot('id',$user_id)->get();
        return view('admin_user.admin.index',compact('app_users'));
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
            'phone' => 'required|min:11',
            'address' => 'required',
        ]);

        $userData = User::find($user_id);
        $userData->username = $request->username;
        $userData->email = $request->email;
        $userData->phone = $request->phone;
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
            'phone' => 'required|min:10',
        ]);

        $user = new User();
        // $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
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
            'phone' => 'required|min:10',
        ]);

        $user = User::findOrFail($request->id);
        // $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
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



}
