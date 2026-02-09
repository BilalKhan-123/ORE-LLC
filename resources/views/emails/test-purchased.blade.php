@component('mail::message')
<br>
{{ __('email.dear') }} {{ $user->full_name }},
<br>
<br>

@php
$productName = $payment['productName'];
$quantity = '';
$hasLine3 = true;
if($payment['examType'] == config('site.exam.exam_type.cci_consultation')) {
$quantity = "(Quantity: " . $payment['quantity'] . ")";
} else if($payment['examType'] == config('site.exam.exam_type.cci_plus')) {
$productName = "CCI+ one consultation";
} else if($payment['examType'] == config('site.exam.exam_type.cci')) {
$hasLine3 = false;
}
@endphp
@if($user->hasRole(config('site.roles.client')))
{!! __('email.testPurchased.line1', ['productName' => $productName, 'quantity' => $quantity]) !!}
<ul>
    <li>{!!__('email.testPurchased.point1', ['clientCode' => $user->client_code]) !!}</li>
    <li>{!!__('email.testPurchased.point2', ['registrationUrl' => $payment['registrationUrl']]) !!}</li>
    <li>{{__('email.testPurchased.point3') }}</li>
    <li>{!!__('email.testPurchased.point4', ['testUrl' => $payment['testUrl']]) !!}</li>
</ul>

@if($hasLine3)
{{ __('email.testPurchased.line3') }}
@endif
@else
{!! __('email.participantTestPurchased.line1', ['productName' => $productName, 'quantity' => $quantity]) !!}
<br>
<ul>
    <li>{!!__('email.participantTestPurchased.point1', ['testUrl' => $payment['testUrl']]) !!}</li>
</ul>
@if($hasLine3)
{{ __('email.participantTestPurchased.line3') }}
<br>
@endif
@endif
<br>
{{ __('email.testPurchased.toWelness') }}
<br>
<strong>Mario Martinez, PsyD</strong>
<br>{{ __('email.testPurchased.collegeName') }}<br>
<a href="https://www.biocognitive.com">www.biocognitive.com</a>
@endcomponent