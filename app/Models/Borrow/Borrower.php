<?php

namespace App\Models\Borrow;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    use HasFactory;

    protected $table = 'borrowers';
    protected $fillable = ['reference', 'first_name', 'last_name', 'gender', 'title', 'mobile', 'email', 'date_birth', 'address', 'city',
        'working_status','business_name','filename', 'attachment_size', 'attachment', 'uploaded_by', 'status','description'];


}
