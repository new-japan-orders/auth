@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@lang('auth::messages.You are receiving this email because we must confirm your email address for your account.')

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@lang('auth::messages.If you did not request a email-confirmation, no further action is required.')

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
@lang(
    "auth::messages.If you’re having trouble clicking the button, copy and paste the URL below into your web browser.",
    [
        'actionText' => $actionText
    ]
)<br />
<a href="{{$actionUrl}}">{{$actionUrl}}</a>

@endcomponent
@endisset
@endcomponent
