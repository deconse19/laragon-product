<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest\ProductRequest\FindRequest;
use App\Http\Requests\CompanyRequest\ProductRequest\AddRequest;
use App\Http\Requests\CompanyRequest\ProductRequest\EditRequest;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(FindRequest $request)
    {
        $list = Product::when($request->search, function ($query, $search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('price', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        })->paginate($request->per_page ?? 15);

        return response()->json(
            [
                'message' => 'List of Products',
                'data' => $list
            ]
        );
    }

    public function add(AddRequest $request)
    {
        try {

            $list = Product::create([
                'company_id' =>$request->company_id,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'category' => $request->category,
                'stock' => $request->stock,

            ]);

            return response()->json([
                'message' => 'Success',
                'status' => $list

            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 422);
        }
    }

    public function edit(EditRequest $request)
    {

        try {
            $list = Product::find($request->id);

            $list = $list->update([
                'company_id' =>$request->company_id,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'category' => $request->category,
                'stock' => $request->stock,

            ]);

            return response()->json([
                'message' => 'Product successfully edited',
                'data' => $list
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request)
    {

        $list = Product::find($request->id);

        $list->softDelete();

        return response()->json([
            'message' => 'Product Deleted',
            'status' => $list

        ]);
    }

    public function restoreDelete(Request $request)
    {

        $list = Product::withTrashed()->find($request->id);

        $list->restore();

        return response()->json([
            'message' => 'Product Restored',
            'status' => $list

        ]);
    }

}
