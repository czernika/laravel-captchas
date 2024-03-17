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
    <div class="">
        <h2>Yandex SmartCaptcha</h2>

        <form action="/send" method="POST">
            @csrf

            {!! Captcha::html() !!}

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
