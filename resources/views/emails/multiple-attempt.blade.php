@component('mail::message')
<br>
{{ __('email.multiAttempt.line1', [
'userName' => $user->first_name . ' ' . $user->last_name
], $user->language)}}
<br>
<br>
{{ __('email.multiAttempt.line2', [], $user->language)}}
@endcomponent