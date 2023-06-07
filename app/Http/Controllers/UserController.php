<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Userinfo;
use Auth;

class UserController extends Controller
{
    public function getUser($id)
    {
        return view('userprofile',[
            'data' => Userinfo::where('userid', $id)->first(),
            'info' => User::where('id', $id)->first()
        ]);
        
    }

    public function viewForm(Request $request, $id)
    {
        $user = Auth::user();
        if($user->id == $id || $user->role_id == 1){
            $request->session()->put("userid", $id);
            return view('userprofileform');
        }else{
            return back();
        }
    }

    public function updateUser(Request $request)
    {
        $id = $request->session()->pull("userid");
        Userinfo::where('userid', $id)->update([
            'description' => $request->description,
            'status' => $request->status,
            'year' => $request->year,
            'phone_number' => $request->phone_number,
            'github_link' => $request->github_link,
            'userid' => $id,
        ]);

        return redirect('/profile/'. $id);
    }
}
