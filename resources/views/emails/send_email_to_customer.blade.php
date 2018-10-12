@component('mail::message')
# New claim created
Hi {{ $customer->name }},

{{ $userName }} has created a claim.

@component('mail::button', ['url' => route('claim.details', ['id', $claimId])])
    View Claim
@endcomponent

Have a nice day.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
