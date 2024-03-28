<?php

namespace App\Http\Controllers\Borrower;

use App\Http\Controllers\Controller;
use App\Models\Borrow\BorrowerAttachment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class BorrowerGroup extends Controller
{



    public function index(Request $request)
    {

        $perPage = request('per_page',10);
        $sortField = request('sort_field','created_at');
        $sortDirection = request('sort_direction','desc');
        return Inertia::render('BorrowGroup/Index',[
            'filters' => FacadesRequest::all('search'),
            'groups' => \App\Models\Borrow\BorrowerGroup::query()
                ->orderBy($sortField, $sortDirection)
                ->filter(FacadesRequest::only('search'))
                ->paginate($perPage,['*'],'groups')
                ->withQueryString()
                ->through(fn ($group) => [
                    'id' => $group->id,
                    'name' => $group->name,
                    'description' =>$group->description,
                     'date' => Carbon::parse($group->created_at)->format('Y-m-d'),
                     'members'=>$group->borrowers->count()
                ])

        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('BorrowGroup/Create');
    }



    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $borrow = \App\Models\Borrow\BorrowerGroup::create([
                'reference' => 'BRG'.rand(1000,9999),
                'name' => $request->filled('name') ? $request->input('name') : null,
                'description' => $request->filled('description') ? $request->input('description') : null,
                'user_id' => Auth::id(),
                'status' => 'pending',
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return Redirect::route('group.index')->with('success','You have added successfully a new borrower');
    }


    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $group = \App\Models\Borrow\BorrowerGroup::findOrFail($id);

        try {
            DB::beginTransaction();
            $group->update([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'description' => $request->filled('description') ? $request->input('description') : null,
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return Redirect::route('group.index')->with('success','You have updated successfully your borrower');
    }

    public function show(Request $request, $id)
    {
        $group = \App\Models\Borrow\BorrowerGroup::with(['borrowers','user'])->findOrFail($id);
        return Inertia::render('BorrowGroup/View',['group' =>$group]);
    }





    public function edit(Request $request, $id)
    {
        $group = \App\Models\Borrow\BorrowerGroup::with('user')->findOrFail($id);
        return Inertia::render('BorrowGroup/Edit',['group' => $group]);
    }

}
