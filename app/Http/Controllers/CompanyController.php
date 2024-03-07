<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest\AddProductRequest;
use App\Http\Requests\CompanyRequest\AddCompanyRequest;
use App\Http\Requests\CompanyRequest\EditCompanyRequest;
use App\Http\Requests\CompanyRequest\FindCompanyRequest;
use App\Http\Requests\CompanyRequest\DeleteCompanyRequest;

use App\Models\Company;
use App\Models\Product;


class CompanyController extends Controller
{

    public function index(FindCompanyRequest $request)
    {
        $list = Company::when($request->search, function ($query, $search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', "%{$search}%")
                ->orWhere('location', 'LIKE', "%{$search}%");
        })->paginate($request->per_page ?? 15);

        return response()->json(
            [
                'message' => 'List of Company',
                'data' => $list
            ]
        );
    }

    public function add(AddCompanyRequest $request)
    {
        try {

            $list = Company::create([
                'name' => $request->name,
                'description' => $request->description,
                'location' => $request->location,
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

    public function edit(EditCompanyRequest $request)
    {

        try {
            $list = Company::find($request->id);

            $list = $list->update([
                'name' => $request->name,
                'description' => $request->description,
                'location' => $request->location,

            ]);

            return response()->json([
                'message' => 'Company successfully edited',
                'data' => $list
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete(DeleteCompanyRequest $request)
    {

        $list = Company::find($request->id);

        $list->delete();

        return response()->json([
            'message' => 'Company Deleted',
            'status' => $list

        ]);
    }

    public function addProduct(AddProductRequest $request){
        $company = Company::findOrFail($request->company_id);
       
        $product_id = $request->product_id;
        $company->product()->sync($product_id);
        $product = Product::findOrFail($product_id);

        return response()->json([$company,$product]);

    }
}
