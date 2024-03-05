<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest\AddProductRequest;
use App\Http\Requests\UserRequest\CreateProfileRequest;
use App\Http\Requests\UserRequest\DeleteProfileRequest;
use App\Http\Requests\UserRequest\SearchRequest;
use App\Models\Product;
use App\Models\User;
use App\Models\UserProfile;


class UserController extends Controller

{

    public function searchUser(SearchRequest $request)
    {
        $user = User::with('userProfile', 'department')->find($request->user_id);

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

    public function addProduct(AddProductRequest $request){
        $user = User::findOrFail($request->user_id);
       
        $product_id = $request->product_id;
        $user->product()->sync($product_id);
        $product = Product::findOrFail($product_id);

        return response()->json([$user,$product]);

    }
    // public function removeProduct(){
    //     $user = User::findOrFail($request->user_id);

    // }
}
 