<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $id = Auth::id();
        if($user->profile == null){
            $profile = Profile::create([
                "user_id" => $id,
                "address" => "test address",
                "phone" =>"+5691011642",
                "contact" => "https://facebook.com/"
            ]);
        }
        return view('dashboard.users.profile.index')->with('user',$user);
    }

    public function update(Request $request, Profile $profile)
    {
        $this->validate($request,[
            'name' =>'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url'
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
        $user->profile->address = $request->address;
        $user->profile->phone = $request->phone;
        $user->profile->contact = $request->contact;
        $user->profile->save();
        return redirect()->route('dashboard.profile.index');
    }

    public function changePassword(Request $request){
        $this->validate($request,[
            'oldPassword'=>'required|min:8|string',
            'newPassword' =>'required|min:8|string',
            'confirmPassword' =>'required|min:8|string|same:newPassword'
        ]);
        $user = Auth::user();

        $check=Hash::check($request->oldPassword,$user->password);
        // dd($check);
        if($check){
            $user->password = Hash::make($request->newPassword);
            $user->save();
        }
        return redirect()->route('dashboard.profile.index');
    }
}
