<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;

class UsersController extends Controller
{
    public function index(){

        $user = User::paginate(20);
        return view('dashboard.users.index')->with('user',$user);
    }

    public function create(){
        // $role=Role::all();
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>"required|string",
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url',
            'password' =>'required|string|min:8',
            'role'=>'required'
        ]);
        // dd($request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
        ]);

        $profile = Profile::create([
            'user_id'=>$user->id,
            'address' =>$request->address,
            'phone'=>$request->phone,
            'contact'=>$request->contact
        ]);
        $user->assignRole($request->role);
        return redirect()->route('dashboard.user.index');
    }

    public function edit(User $user){
        // $role=Role::all();
        // $userRole = DB::table('model_has_roles')->where('model_id',$user->id)->pluck('role_id','role_id')->first();
        // dd($userRole);
        return view('users.edit')->with('user',$user);
    }

    public function update(Request $request, User $user){
        $this->validate($request,[
            'name' =>"required|string",
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'contact' => 'required|url',
            'role' =>'required'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->profile->phone = $request->phone;
        $user->profile->address = $request->address;
        $user->profile->contact = $request->contact;
        $user->profile->save();
        // DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        // $user->assignRole($request->role);
        return redirect()->route('dashboard.user.index');
    }

    public function destroy(User $user){
        $user->delete($user->id);
        return redirect()->route('dashboard.user.index');
    }
}
