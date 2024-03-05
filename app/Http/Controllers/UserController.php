<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserProfile;
use GuzzleHttp\Psr7\Request;

class UserController extends Controller

{

    public function searchUser(UserRequest $request){
       $user = User::with('userProfile','department')->find($request->user_id);

       return response()->json([
        
        'user'=>$user,
       
    
    ]);


    }

    public function createUserProfile(UserRequest $request)
    {
        $user = UserProfile::updateOrCreate([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'address' => $request->address,
            'status' => $request->status,
            'phone' => $request->phone,
        ]);

        return response()->json($user);
    }

    public function userDelete(UserRequest $request)
    {

        $list = UserProfile::find($request->id);

        $list->delete();

        return response()->json([
            'message' => 'User Deleted',
            'status' => $list

        ]);
    }
}
