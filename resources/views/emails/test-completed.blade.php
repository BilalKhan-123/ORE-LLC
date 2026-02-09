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
        <p>{{ __('email.dear') }} {{ $user->first_name }},</p>
        @if($result['exam_type'] == config('site.exam.exam_type.cci'))
        <p>{{ __('email.cciTestCompleted.line1') }}</p>
        <p>{{ __('email.cciTestCompleted.line2') }}</p>
        <p style="margin-bottom: 0;">{!! __('email.cciTestCompleted.line3') !!}</p>
        <p>{!! __('email.cciTestCompleted.line4') !!}</p>
        @elseif($result['exam_type'] == config('site.exam.exam_type.cci_plus'))
        <p>{{ __('email.cciPlusTestCompleted.line1') }}</p>
        <p>{{ __('email.cciPlusTestCompleted.line2') }}</p>
        <p>{{ __('email.cciPlusTestCompleted.line3') }}</p>
        <p>{{ __('email.cciPlusTestCompleted.line4') }}</p>
        <p style="margin-bottom: 0;">{!! __('email.cciPlusTestCompleted.line5') !!}</p>
        @elseif($result['exam_type'] == config('site.exam.exam_type.cci_consultation'))
        <p>{{ __('email.cciConsultationTestCompleted.line1') }}</p>
        <p>{{ __('email.cciConsultationTestCompleted.line2') }}</p>
        <p>{{ __('email.cciConsultationTestCompleted.line3') }}</p>
        <p style="margin-bottom: 0;">{!! __('email.cciConsultationTestCompleted.line4') !!}</p>
        @endif
        <p>{{ __('email.commonText.beWell') }}</p>
        <p>{{ __('email.commonText.teamName') }}</p>
    </div>
</body>

</html>