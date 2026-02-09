@php
$user = $data['user'];
$token = $data['token'];
$url = ($user->hasRole(config('site.roles.user')) ? url(config('site.participantWebsiteUrl')) : url(config('site.frontWebsiteUrl'))) . '/reset-password?token=' . $token . '&email=' . $user->email;
@endphp
{{ __('email.dear') }} {{ $user->full_name }},
<br>
<br>
{{ __('email.forgetPassword.line1') }}
<br>
<br>
{{ __('email.forgetPassword.line2') }}
<a href="{{ $url }}" target="_blank">{{ __('email.forgetPassword.clickHere') }}</a>
<br>
<br>
{{ __('email.forgetPassword.line3') }}
<br>
<br>
{{ __('email.forgetPassword.line4') }}
<br>
<br>
{{ __('email.forgetPassword.line5') }}
<br>
<br>
{{ __('email.regards') }},
<br>
{{ __('email.appName') }}