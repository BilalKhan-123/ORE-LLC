<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div style="padding: 1rem;">
        <p>{{ __('email.dear') }} {{ $user->full_name }},</p>

        @if($payment['examType'] == config('site.exam.exam_type.cci'))
        <p>{{ __('email.cciPaymentPaid.line1') }}</p>
        <p>{{ __('email.cciPaymentPaid.line2') }}</p>
        <p>{!! __('email.cciPaymentPaid.line3') !!}</p>
        <p style="margin-bottom: 0;">{!! __('email.cciPaymentPaid.line4') !!}</p>
        <p>{!! __('email.cciPaymentPaid.line5') !!}</p>
        <p>{{ __('email.cciPaymentPaid.toWelness') }}</p>
        <p><strong>Mario Martinez, PsyD</strong><br>{{ __('email.cciPaymentPaid.collegeName') }}<br><a href="https://www.biocognitive.com">www.biocognitive.com</a></p>
        @else
        <p>{{ __('email.glycanagePaymentPaid.line1') }}</p>
        <p>{{ __('email.glycanagePaymentPaid.line2') }}</p>
        <p>{!! __('email.glycanagePaymentPaid.line3') !!}</p>
        <p style="margin-bottom: 0;">{!! __('email.glycanagePaymentPaid.line4') !!}</p>
        <p>{!! __('email.glycanagePaymentPaid.line5') !!}</p>
        <p>{{ __('email.glycanagePaymentPaid.toWelness') }}</p>
        <p><strong>Mario Martinez, PsyD</strong><br>{{ __('email.glycanagePaymentPaid.collegeName') }}<br><a href="https://www.biocognitive.com">www.biocognitive.com</a></p>
        @endif
    </div>
</body>

</html>