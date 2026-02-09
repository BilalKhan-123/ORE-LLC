<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<body>
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:70%;padding:20px 0">
            <p style="font-size:1.1em; margin-top:20px; ">{{ __('email.dear') }} {{ $user->full_name }},</p>

            @if(auth('sanctum')->check())
            <p>{{__('email.signupEmailLine1')}}</p>

            <p>{{__('email.signupEmailLine2')}}</p>
            <ul style="margin-left: 0; padding-left: 0;">
                <li><span><strong>{{__('email.usernameOrEmail')}} </strong></span> {{ $user->email }}</li>
                <li><span><strong>{{__('email.temporaryPassword')}}</strong></span> {{ $password }}</li>
                @if(!(auth('sanctum')->user()->hasRole(config('site.roles.admin')) && $user->hasRole(config('site.roles.user'))))
                <li><span><strong>{{__('email.clinicCode')}} </strong></span> {{ ($user->hasRole(config('site.roles.user')) ? (!empty($user->client) ? $user->client->client_code : '-') : (!empty($user->client_code) ? $user->client_code : '-')) }}</li>
                @endif
            </ul>
            <p>{{__('email.signupEmailLine3')}}</p>

            @php $regUrl = (($user->hasRole(config('site.roles.user')) ? config('site.participantWebsiteUrl') : config('site.frontWebsiteUrl')).'/login'); @endphp

            <ul style="margin-left: 0; padding-left: 0;">
                <li>{!!__('email.signupEmailLine4', ['roleName' => $user->getRoleNames()->first(), 'regUrl' => $regUrl]) !!}</li>
                <li>{{__('email.signupEmailLine5')}}</li>
                <li>{{__('email.signupEmailLine6')}}</li>
            </ul>
            @else
            <p>{{__('email.participantSignupEmail1', ['role' => ($user->hasRole(config('site.roles.user')) ? config('site.roles.user') : config('site.roles.client'))]) }}</p>
            <p>{{__('email.participantSignupEmail2')}}</p>
            <p>{{__('email.participantSignupEmail3')}}</p>
            @endif

            <p style="font-size:0.9em;margin-top:10px;">{{__('email.regards')}}<br />{{ config('app.name') }}</p>
        </div>
    </div>
</body>

</html>