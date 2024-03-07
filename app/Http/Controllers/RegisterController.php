<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest\LoginRequest;
use App\Http\Requests\UserRequest\RegisterRequest;
use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([

                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            Mail::to($request->email)->send(new VerificationMail($user));

            DB::commit();
            return response()->json([
                'message' => 'User register successfully.',
                'status'    => $user
            ]);
        } catch (\Exception $e) {
 
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->email_verified_at === null) {

                return response()->json([
                    'message' => 'email not verified',
                ], 422);
            }
            $success['token'] = $user->createToken('Token')->accessToken;
            $success['name'] = $user->name;
            $token = $success['token'];
            $profile = $success['name'];

            return response()->json([
                'message' => 'Welcome '. $user->name,
                'status' => $profile,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'message' => 'Credentials does not match?',

            ]);
        }
    }
    public function logout()
    {

        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }
    

    
}
