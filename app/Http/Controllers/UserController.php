<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Schedule;
use App\Models\Client;
use App\Models\AssessmentRecord;

class UserController extends Controller
{

    public function Index()
    {
        return view('frontend.index');
    } // End Method

    public function UserProfile(){

        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.edit-profile',compact('userData'));

    } // End Method 

    public function UserProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address; 

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName(); 
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;  
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

     }// End Method 

    public function UserLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

         $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        ); 
        return redirect('/login')->with($notification);
    }// End Method 

    public function UserChangePassword(){

        return view('frontend.dashboard.change-password');

    }// End Method 


    public function UserPasswordUpdate(Request $request){

        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'

        ]);

        /// Match The Old Password

        if (!Hash::check($request->old_password, auth::user()->password)) {

           $notification = array(
            'message' => 'Old Password Does not Match!',
            'alert-type' => 'error'
        );

        return back()->with($notification);
        }

        /// Update The New Password 

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

         $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification); 

     } // End Method

     public function UserScheduleRequest(){

        $id = Auth::user()->id;
        $userData = User::find($id);

        $srequest = Schedule::where('user_id',$id)->get();
        return view('frontend.message.schedule-request',compact('userData','srequest'));

    } // End Method 



    public function LiveChat(){

        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.live-chat',compact('userData'));

    } // End Method 

   
    public function viewUsers()
    {
        {
            $allUsers = User::where('role', 'user')->get();
        
            return view('admin.users.index', compact('allUsers'));
        }
    }

    public function showDashboard()
    {
        $assessmentRecords = AssessmentRecord::all(); // Adjust this query based on your actual model and requirements

        return view('frontend.dashboard.dashboard-sidebar', ['assessmentRecords' => $assessmentRecords]);
    }

    
    
}
