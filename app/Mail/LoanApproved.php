<?php

namespace App\Mail;

use App\Models\LoanApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoanApproved extends Mailable
{
    use Queueable, SerializesModels;


    public $LoanApplication ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LoanApplication $LoanApplication )
    {
        $this->LoanApplication  = $LoanApplication ;

        // dd($this->LoanApplication);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.loan_details')->subject('Loan Approved with Markdown');
    }
}
