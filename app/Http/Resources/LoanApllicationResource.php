<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanApllicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'loan_amount' => $this->loan_amount,
            'loan_tenure' => $this->loan_tenure,
            'loan_intrest_rate' => $this->loan_intrest_rate,
            'description' => $this->description,
            'status' => $this->status->name,
            'date' => $this->created_at->toFormattedDateString(),
            'user_name' => $this->user->name,
            'user_email' => $this->user->email,
        ];

    }
}
