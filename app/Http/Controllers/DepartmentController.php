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

   

}
