@component('mail::message')

Dear {{ $LoanApplication->user->name }},

Your Loan request has been approved. See the attached pdf file for deatils:

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
