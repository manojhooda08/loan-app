<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class LoanApplication extends Model
{
    use HasFactory;
  
    protected $fillable = ['loan_amount','loan_tenure','loan_intrest_rate','user_id','status_id'];

    public function status()
    {
        return $this->hasOne(Status::class, 'id','status_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function emi()
    {
       return $this->hasOne(LoanEmi::class);
    }

    public function transactions()
    {
        return $this->hasMany(LoanTransaction::class);
    }

}
