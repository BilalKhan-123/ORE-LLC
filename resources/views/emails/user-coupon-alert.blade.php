<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .px-3 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .ml-3 {
            margin-left: 1rem;
        }
        .pl-2 {
            padding-left: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="px-3">
        <p class="ml-3 pl-2">{{ __('email.dear') }} {{ $user->full_name }},</p>

        @php $paymentUrl = (($user->hasRole(config('site.roles.user')) ? config('site.participantWebsiteUrl').'/cci-home' : config('site.frontWebsiteUrl').'/purchase-plan')); @endphp

        <p class="ml-3 pl-2">{{ __('email.userCouponAlert.line1') }}</p>
        <p class="ml-3 pl-2" style="margin-bottom: 0;">{!! __('email.userCouponAlert.line2', ['couponCode' => $promotionCode['couponCode']]) !!}</p>
        <p class="ml-3 pl-2" style="margin-bottom: 0;">{!! __('email.userCouponAlert.line3', ['discount' => $promotionCode['discount']]) !!}</p>
        <p class="ml-3 pl-2">{!! __('email.userCouponAlert.line4', ['validUntil' => $promotionCode['validUntil']]) !!}</p>
        <p class="ml-3 pl-2">{!! __('email.userCouponAlert.line5', ['paymentUrl' => $paymentUrl]) !!}</p>
        <p class="ml-3 pl-2" style="margin-bottom: 0;">{!! __('email.userCouponAlert.line6') !!}</p>
        <p class="ml-3 pl-2">{!! __('email.userCouponAlert.line7') !!}</p>
        <p class="ml-3 pl-2">{{ __('email.userCouponAlert.toWelness') }}</p>
        <p class="ml-3 pl-2"><strong>Mario Martinez, PsyD</strong><br>{{ __('email.userCouponAlert.collegeName') }}<br><a href="https://www.biocognitive.com">www.biocognitive.com</a></p>
    </div>
</body>

</html>