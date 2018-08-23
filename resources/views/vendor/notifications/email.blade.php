@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# @lang('Oh đã có lỗi xảy ra!')
@else
    <img src="https://login.thanglong.edu.vn/images/logotlu.jpg" alt="TLU">
#    <h1>Thông báo đến từ ThangLongUniversity!</h1>
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach

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
@foreach ($outroLines as $line)
{{ $line }}
@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
#    <p><a href="thanglong.edu.vn" style="text-decoration: none; font-size: 12px"><b>ThangLong University</b></a></p>
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
# <p>Nếu có lỗi xảy ra trong khi nhấn vào button trên. Vui lòng copy URL này: <a href="{{$actionUrl}}">{{$actionUrl}}</a> và dán vào thanh địa chỉ trên trình duyệt của bạn! Xin cảm ơn</p>
# <p style="float: right">&copy; DauQuan</p>
@endcomponent
@endisset
@endcomponent
