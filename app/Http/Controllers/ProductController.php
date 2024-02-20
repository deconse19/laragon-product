<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\FindProductRequest;
use App\Http\Requests\AddRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(FindProductRequest $request)
    {

        $list = Product::when($request->search, function ($query, $search) {
                $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('price', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('category', 'LIKE', "%{$search}%");
            })
            ->get();


        return response()->json($list);
    }

    public function add(AddRequest $request)
    {

        $request->validated();

        $list = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category
        ]);

        return response()->json($list);
    }

    public function edit(AddRequest $request)
    {

        $request->validated();

        $list = Product::find($request->id);

        $list->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);

        return response()->json($list);
    }

    public function delete(Request $request)
    {

        $list = Product::find($request->id);

        $list->delete();

        return response()->json([
            'message' => 'Deleted',
            'status' => $list

        ]);
    }
}
