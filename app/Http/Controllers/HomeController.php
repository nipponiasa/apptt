<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Hash;


class HomeController extends Controller
{
    



    public function fetch_user_info(Request $request)
    {
        $userid = intval($request->input('userid'));
        $user_current = DB::table('users')->where('id', $userid)->first();
//dd( $moto_current);
        return view('user_edit_form')->with('user_current',$user_current);
    }

    public function update_user(Request $request, User $users)
    {
       
        $user = User::find(intval($request->input('id')));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role=$request->input('role');
       
        $user->save();
        return redirect()->route('user_list');


    }

    public function fetch_user_info_password(Request $request)
    {
        $userid = intval($request->input('userid'));
        $user_current = DB::table('users')->where('id', $userid)->first();
//dd( $moto_current);
        return view('user_password_reset')->with('user_current',$user_current);
    }

    public function reset_user_password(Request $request, User $users)
    {
       
        $user = User::find(intval($request->input('id')));
        //dd($user);
        $user ->password=Hash::make($request->input('password'));
       
        $user->save();
        return redirect()->route('user_list');


    }





    public function user_delete(Request $request, User $users)
    {
       
        $user = User::find(intval($request->input('userid')));
        $user->delete();
        return redirect()->route('user_list');


    }







    public function create_user(Request $request, User $users)
    {
       
        $user = new User;
        $user ->name = $request->input('name');
        $user ->email = $request->input('email');
        $user ->password=Hash::make($request->input('password'));
        $user ->role = $request->input('role');
        $user->save();
        return redirect()->route('user_list');

        
    }






















  
}
