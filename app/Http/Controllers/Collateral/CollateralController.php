<?php

namespace App\Http\Controllers\Collateral;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollateralRequest;
use App\Models\Borrow\BorrowerAttachment;
use App\Models\Collateral\Collateral;
use App\Models\Loan\LoanAttachment;
use App\Models\Loan\LoanComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class CollateralController extends Controller
{




    public function store(CollateralRequest $request, $loanId){

        $validatedData = $request->validated();
        try {
           DB::beginTransaction();
            Collateral::create([
                'loan_id' => $loanId,
                'type_id' => $validatedData['typeId'],
                'name' =>$request->filled('name') ? $request->input('name') :null,
                'product_name' => $validatedData['product_name'],
                'amount' => $validatedData['amount'],
                'date' => $request->filled('date') ? $request->input('date') : null,
                'condition' => $request->filled('condition') ? $request->input('condition') : null,
                'description' => $request->filled('comment') ? $request->input('comment') : null,
                'attachment' => $request->hasFile('file') ? $request->file('file')->store('file') : null,
                'filename' => $request->hasFile('file') ? $request->file('file')->getClientOriginalName() : null,
                'attachment_size' => $request->hasFile('file') ? $request->file('file')->getSize() : null,
                'user_id' => Auth::id()

            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return Redirect::back()->with('success','You have added successfully a new collateral');
    }



    public function downloadAttachment(Request $request, $id){

        $file = Collateral::findOrFail($id);
        $filePath = storage_path('app/'. $file->attachment);

        return response()->download($filePath, $file->filename);
    }


    public function attachment(Request $request, $loanId)
    {

        $validatedData= $request->validate([
            'filename' => 'required',
            'file' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $attach = $request->file('file');
            $filename = $attach->getClientOriginalName();
            $filesize = $attach->getSize();
            $path = $attach->store('file');
            LoanAttachment::create([
                'loan_id' => $loanId,
                'name' => $validatedData['filename'],
                'filename' => $request->input('name'),
                'file' => $filename,
                'attachment' => $path,
                'attachment_size' => $filesize,
                'uploaded_by' => Auth::id(),
                'type' => 'loan'
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
        }
        return Redirect::back()->with('success','You have added successfully a new agreement file');
    }


    public function downloadFile(Request $request, $id){

        $file = LoanAttachment::findOrFail($id);
        $filePath = storage_path('app/'. $file->attachment);

        return response()->download($filePath, $file->filename);
    }


    public function storeComment(Request $request, $loanId){

        $validatedData = $request->validate([
            'comment' => 'required'
        ]);
        try {
            DB::beginTransaction();
            LoanComment::create([
                'loan_id' => $loanId,
                'description' => $validatedData['comment'],
                'user_id' => Auth::id()

            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return Redirect::back()->with('success','You have added successfully a new comment');
    }
}

