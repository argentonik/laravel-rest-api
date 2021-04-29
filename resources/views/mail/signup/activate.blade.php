@component('mail::message')
# You have been activated.

Your account has been confirmed.

@component('mail::button', ['url' => url('/')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
