<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $list = Category::all();

        return response()->json($list);
    }

    public function add(AddCategoryRequest $request)
    {
        try {

            $category = Category::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'message' => 'Success',
                'status' => $category

            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 422);
        }
    }

    public function update(UpdateCategoryRequest $request)
    {
        $category = Category::find($request->id);

        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json($category);
    }
}
