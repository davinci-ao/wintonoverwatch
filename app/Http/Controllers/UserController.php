<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Userinfo;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use App\Models\Student_Event;
use App\Models\Student_Event_Company;

class UserController extends Controller
{
    //Retrieves the current user's details to display on their profile
    public function getUser($id)
    {
        $user = Auth::user();

        if (Userinfo::where('userid', $user->id)->exists()) {
            return view('userprofile',[
                'data' => Userinfo::where('userid', $id)->first(),
                'info' => User::where('id', $id)->first()
            ]);
        }else{
            $info = new Userinfo;

            $info->description = "Your text here.";

            $info->userid = $user->id;

            $info->save();
        }
      
        return view('userprofile',[
            'data' => Userinfo::where('userid', $id)->first(),
            'info' => User::where('id', $id)->first()
        ]);
        
    }

    //Checks if the user is an admin before it redirects to a form
    public function viewForm(Request $request, $id)
    {
        $user = Auth::user();
        if($user->id == $id || $user->role_id == 1){
            $request->session()->put("userid", $id);
            return view('userprofileform',[
                'data' => Userinfo::where('id', $id)->first()
            ]);
        }else{
            return back();
        }
    }

    //Updates the user details
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

    //Retrieves a list of all users
    public function getAllUsers(){
        $users = User::all();

        return view('/overviewusers')->with('users', $users);
    }

    // Redirect of geef een antwoord terug aan de gebruiker
    public function handleForm(Request $request)
    {
        $action = $request->input('action');

        if ($action === 'update') {
            $this->updateRoles($request);
        } elseif ($action === 'delete') {
            $this->deleteSelected($request);
        }
    }

    //Function for an admin to delete a user
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) 
        {
            Student_Event::where('user_id', $user->id)
                            ->delete();
            Student_Event_Company::where('user_id', $user->id)
                            ->delete();
            $user->delete();
        }
        $users = User::all();
        return view('/overviewusers')->with('users', $users);
    }

    //Function for an admin to change the roles of all users
    public function updateRoles(Request $request, $id)
    {
        User::where('id', $id)->update(['role_id' => $request->role_id]);   
        $users = User::all();
        return view('/overviewusers')->with('users', $users);     
    }
}
