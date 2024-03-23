<?php

namespace App\Http\Controllers\Borrower;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BorrowerController extends Controller
{





    public function create(Request $request)
    {
       return Inertia::render('Borrow/Create');
    }
}
