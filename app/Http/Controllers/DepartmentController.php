<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function createDepartment(UserRequest $request){

        $user = Department::create([
            'name' => $request->name
        ]);

        return response()->json($user);
    }

    // public function updateUserDepartment(UserRequest $request){

    //     $department=Department::findOrFail($request->id);

    //     $user -= User::update([
    //         'department_id' => $request->department_id,
    //         'user_id' => $request->user_id,
    //         'name' => $request->name,
    //         'age' => $request->age,
    //         'gender' => $request->gender,
    //         'address' => $request->address,
    //         'status' => $request->status,
    //         'phone' => $request->phone,
    //     ]);

    //     return response()->json($user);
    // }

}
