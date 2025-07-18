@component('mail::message')
# Inactivity Notice

Dear {{ $beneficiaryName }},

Your account has been marked as inactive due to prolonged inactivity.

If no action is taken within {{ $daysRemaining }} days, your vault will be released to beneficiaries.

@component('mail::button', ['url' => route('inactivity.settings')])
    Update Activity
@endcomponent

Thank you,  
{{ config('app.name') }}
@endcomponent
