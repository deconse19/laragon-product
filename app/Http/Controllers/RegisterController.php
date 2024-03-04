<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            //kmjnjnnjnjn

            Mail::to($request->email)->send(new VerificationMail($user));//aaaaa

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

    public function login(UserLoginRequest $request)
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
                'message' => 'Welcome user',
                'status' => $profile,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'message' => 'Credentials does not match?',

            ]);
        }
    }
}
