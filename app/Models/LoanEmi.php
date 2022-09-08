<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanEmi extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_application_id',
        'outstanding_amount',
        'monthly_emi',
        'emi_date',
        'outstanding_emis',
    ];

}
