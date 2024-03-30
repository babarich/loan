<?php

namespace App\Http\Controllers\Borrower;

use App\Http\Controllers\Controller;
use App\Models\Borrow\Guarantor;
use App\Models\Borrow\GuarantorAttachment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;
use Inertia\Inertia;

class GuarantorController extends Controller
{


    public function index(Request $request)
    {

        $perPage = request('per_page',10);
        $sortField = request('sort_field','created_at');
        $sortDirection = request('sort_direction','desc');
        return Inertia::render('Guarantor/Index',[
            'filters' => FacadesRequest::all('search'),
            'guarantors' => Guarantor::query()
                ->orderBy($sortField, $sortDirection)
                ->filter(FacadesRequest::only('search'))
                ->paginate($perPage,['*'],'guarantors')
                ->withQueryString()
                ->through(fn ($guarantor) => [
                    'id' => $guarantor->id,
                    'reference' => $guarantor->reference,
                    'name' => $guarantor->first_name . ' '. $guarantor->last_name,
                    'business' =>$guarantor->business_name,
                    'gender'=> $guarantor->gender,
                    'email'=> $guarantor->email,
                    'mobile'=> $guarantor->mobile,
                    'address'=> $guarantor->address,
                    'status' => $guarantor->status,
                ])

        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Guarantor/Create');
    }



    public function store(Request $request)
    {

        $data = $request->validate([
            'image' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'file' => 'required',
        ]);
        $relativePath = '';
        try {
            DB::beginTransaction();
            if (isset($data['image'])) {
                $relativePath  = $this->saveImage($data['image']);
                $data['image'] = $relativePath;
            }
            $guarantor = Guarantor::create([
                'reference' => 'GAN'.rand(1000,9999),
                'first_name' => $request->filled('firstname') ? $request->input('firstname') : null,
                'last_name' => $request->filled('lastname') ? $request->input('lastname') : null,
                'gender' => $request->filled('gender') ? $request->input('gender') : null,
                'title' => $request->filled('title') ? $request->input('title') : null,
                'mobile' => $request->filled('mobile') ? $request->input('mobile') : null,
                'email' => $request->filled('email') ? $request->input('email') : null,
                'date_birth' => $request->filled('birth') ? $request->input('birth') : null,
                'address' => $request->filled('address') ? $request->input('address') : null,
                'city' => $request->filled('city') ? $request->input('city') : null,
                'working_status' => $request->filled('working') ? $request->input('working') : null,
                'business_name' => $request->filled('business') ? $request->input('business') : null,
                'filename' =>  $request->filled('image_url') ? $request->input('image_url') : null,
                'attachment_size' => null,
                'attachment' => $request->filled('image') ? $relativePath: null,
                'uploaded_by' => Auth::id(),
                'status' => 'pending',
                'description' => $request->filled('description') ? $request->input('description') : null,
            ]);

            if($request->hasFile('file')){
                foreach ($request->file('file') as $attach){
                    $filename = $attach->getClientOriginalName();
                    $filesize = $attach->getSize();
                    $path = $attach->store('file');
                    GuarantorAttachment::create([
                        'guarantor_id' => $guarantor->id,
                        'filename' => $filename,
                        'attachment_size' => $filesize,
                        'attachment' => $path,
                        'uploaded_by' => Auth::id()
                    ]);
                }

            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create guarantor try again');
        }

        return Redirect::route('guarantor.index')->with('success','You have added successfully a new guarantor');
    }


    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
        $guarantor = Guarantor::findOrFail($id);
        $relativePath = '';
        try {
            DB::beginTransaction();
            if ($request->filled('image')) {
                $relativePath  = $this->saveImage($request->input('image'));

            }
            $guarantor->update([
                'first_name' => $request->filled('firstname') ? $request->input('firstname') : null,
                'last_name' => $request->filled('lastname') ? $request->input('lastname') : null,
                'gender' => $request->filled('gender') ? $request->input('gender') : null,
                'title' => $request->filled('title') ? $request->input('title') : null,
                'mobile' => $request->filled('mobile') ? $request->input('mobile') : null,
                'email' => $request->filled('email') ? $request->input('email') : null,
                'date_birth' => $request->filled('birth') ? Carbon::parse($request->input('birth'))->format('Y-m-d') : null,
                'address' => $request->filled('address') ? $request->input('address') : null,
                'city' => $request->filled('city') ? $request->input('city') : null,
                'working_status' => $request->filled('working') ? $request->input('working') : null,
                'business_name' => $request->filled('business') ? $request->input('business') : null,
                'filename' =>  $request->filled('image_url') ? $request->input('image_url') : null,
                'attachment_size' => null,
                'attachment' => $request->filled('image') ? $relativePath: null,
                'description' => $request->filled('description') ? $request->input('description') : null,
            ]);

            if($request->hasFile('file')){
                foreach ($request->file('file') as $attach){
                    $filename = $attach->getClientOriginalName();
                    $filesize = $attach->getSize();
                    $path = $attach->store('file');
                    GuarantorAttachment::create([
                        'guarantor_id' => $guarantor->id,
                        'filename' => $filename,
                        'attachment_size' => $filesize,
                        'attachment' => $path,
                        'uploaded_by' => Auth::id()
                    ]);
                }

            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create guarantor try again');
        }

        return Redirect::route('guarantor.index')->with('success','You have updated successfully your guarantor');
    }

    public function show(Request $request, $id)
    {
        $guarantor = Guarantor::with(['attachments','user'])->findOrFail($id);
        return Inertia::render('Guarantor/View',['guarantor' =>$guarantor]);
    }





    public function edit(Request $request, $id)
    {
        $guarantor = Guarantor::with(['attachments','user'])->findOrFail($id);
        return Inertia::render('Guarantor/Edit',['guarantor' => $guarantor]);
    }

    public function downloadAttachment(Request $request, $id){

        $file = GuarantorAttachment::findOrFail($id);
        $filePath = storage_path('app/'. $file->attachment);

        return response()->download($filePath, $file->filename);
    }

    private function saveImage($image)
    {
        // Check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            // Get file extension
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }

}
