<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest\AddProductRequest;
use App\Http\Requests\UserRequest\CheckOutRequest;
use App\Http\Requests\UserRequest\CreateProfileRequest;
use App\Http\Requests\UserRequest\DeleteProfileRequest;
use App\Http\Requests\UserRequest\SearchRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller

{

    public function searchUser(SearchRequest $request)
    {
        $user = User::with('userProfile')->find($request->user_id);

        return response()->json($user);
    }

    public function createUserProfile(CreateProfileRequest $request)
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

    public function userDeleteProfile(DeleteProfileRequest $request)
    {

        $list = UserProfile::find($request->id);

        $list->delete();

        return response()->json([
            'message' => 'User Deleted',
            'status' => $list

        ]);
    }

    public function purchase(CheckOutRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $product = Product::findOrFail($request->product_id);

        $transaction = Transaction::updateOrCreate(
            [
                'user_id' => $user->id,
                'product_id' => $product->id,
            ],
            [
                'quantity' => $request->quantity,
            ]
        );

        return response()->json([

            'transaction' => $transaction
        ]);
    }
}
 // $product_id = $request->product_id;
        // $user->transaction()->sync($product_id);
        // $product = Product::findOrFail($product_id);