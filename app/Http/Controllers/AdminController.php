<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view("admin.index");
    } //End Method

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        $notification = array(
            'message' => 'Logout Success',
            'alert-type' => 'success'
        );

        return redirect('/admin/login')->with($notification);
    } //End Method

    public function AdminLogin(){
        return view('admin.admin_login');
    } //End Method


    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));
    } //End Method

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        
        } //End Method

        public function AdminChangePassword(){
            $id = Auth::user()->id;
            $profileData = User::find($id);
    
            return view('admin.admin_change_password',compact('profileData'));

        } //End Method

    public function AdminUpdatePassword(Request $request)
    {
        //Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        ///Match the Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        } //End Method

        ///Update the New Password
        User::whereId(Auth::user()->id)->update([
            'password'=> Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
        
        
    } //End Method

    // Agent User All Method 
    public function AllAgent(){
        $allagent = User::where('role','agent')->get();
        return view('backend.agentuser.all_agent',compact('allagent'));
    }// End Method 

    public function AddAgent(){
        return view('backend.agentuser.add_agent');
    }// End Method 
    public function StoreAgent(Request $request){
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'active', 
        ]);
        $notification = array(
                'message' => 'Agent Created Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.agent')->with($notification); 
    }// End Method 

    public function EditAgent($id){
        $allagent = User::findOrFail($id);
        return view('backend.agentuser.edit_agent',compact('allagent'));
    }// End Method 
    public function UpdateAgent(Request $request){
        $user_id = $request->id;
        User::findOrFail($user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address, 
        ]);
        $notification = array(
                'message' => 'Agent Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.agent')->with($notification);  
    }// End Method 
    public function DeleteAgent($id){
        User::findOrFail($id)->delete();
        $notification = array(
                'message' => 'Agent Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification); 
    }// End Method 

    public function changeStatus(Request $request){
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success'=>'Status Change Successfully']);
    }// End Method 
    


}
