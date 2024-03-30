<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Loan\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $perPage = request('per_page',10);
        $sortField = request('sort_field','created_at');
        $sortDirection = request('sort_direction','desc');
        return Inertia::render('Products/Index',[
            'filters' => FacadesRequest::all('search'),
            'products' => Product::query()
                ->orderBy($sortField, $sortDirection)
                ->filter(FacadesRequest::only('search'))
                ->paginate($perPage,['*'],'products')
                ->withQueryString()
                ->through(fn ($group) => [
                    'id' => $group->id,
                    'name' => $group->name,
                    'description' =>$group->description,
                    'date' => Carbon::parse($group->created_at)->format('Y-m-d'),
                ])

        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Products/Create');
    }



    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::create([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'description' => $request->filled('description') ? $request->input('description') : null,
                'user_id' => Auth::id(),
                'status' => 'pending',
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan product try again');
        }

        return Redirect::route('product.index')->with('success','You have added successfully a new loan product');
    }


    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $product = Product::findOrFail($id);

        try {
            DB::beginTransaction();
            $product->update([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'description' => $request->filled('description') ? $request->input('description') : null,
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan product try again');
        }

        return Redirect::route('product.index')->with('success','You have updated successfully your loan product');
    }

    public function show(Request $request, $id)
    {
        $product = Product::with('user')->findOrFail($id);
        return Inertia::render('Products/View',['product' =>$product]);
    }





    public function edit(Request $request, $id)
    {
        $product = Product::with('user')->findOrFail($id);
        return Inertia::render('Products/Edit',['product' => $product]);
    }

}
