<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {!! Captcha::js() !!}
</head>
<body>
    @foreach ($errors->all() as $error)
        <div class="">{{ $error }}</div>
    @endforeach

    <div class="">
        <h2>Yandex SmartCaptcha</h2>

        <form action="/send-yandex" method="POST">
            @csrf

            {!! Captcha::html() !!}
            {{-- <x-captcha data-sitekey="{{ config('captchas.keys.client') }}" /> --}}

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
