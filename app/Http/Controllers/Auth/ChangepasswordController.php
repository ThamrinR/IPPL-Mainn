<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
// use Hash;
use Illuminate\Support\Facades\Hash;
class ChangepasswordController extends Controller
{
    public function dashboard(){
    	return view('profile.dashboard');
    }


    public function edit_profile(){
    	$user=auth()->user();
    	$data['user']=$user;
    	return view('profile.edit_profile',$data);
    }

    public function update_profile(Request $request){
    	 $request->validate([
         'first_name'=>'required|min:2|max:100',
         'last_name'=>'required|min:2|max:100',
         ],[
            'first_name.required'=>'First name is required',
            'last_name.required'=>'Last name is required',
         ]);

         $user=auth()->user();

        //  $user->update([
        //  	'first_name'=>$request->first_name,
        //  	'last_name'=>$request->last_name,
        //  ]);

         return redirect()->route('edit_profile')->with('success','Profile successfully updated');

    }

    public function edit($id)
    {
        $editpasw = User::find($id);

        return view('editpasw', compact('editpasw'));
    }

    public function update(Request $request,$id){
        // $request->validate([
        // 'old_password'=>'required|min:8',
        // 'password' => 'required|string|confirmed|min:8',
        // ]);
        $User = User::find($id);
        $User->password = bcrypt($request->get('password'));
        $User->save();
        // $current_user=auth()->user();
        //   $user=$current_user;
        // if(Hash::check($request->old_password,$current_user->password)){
        //   User::find(auth()->id())-> update(['password' => bcrypt($request->password)]);
        //     // $current_user->password=bcrypt($request->password);
        //     // $current_user -> save();
        //   // dd($current_user, $user);
        return redirect()->route('profile')->with('success','Password successfully updated.');

  


    }

}