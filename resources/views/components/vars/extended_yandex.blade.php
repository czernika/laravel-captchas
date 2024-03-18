<div>
    <div id="smartcaptcha-container"></div>
    <script>
        function onloadFunction() {
            if (window.smartCaptcha) {
                const container = document.getElementById('smartcaptcha-container');
                const smartCaptchaWidgetId = window.smartCaptcha.render(container, JSON.parse({!! json_encode($options) !!}));

                @includeUnless('' === config('captchas.options.extended_yandex.subscription_view'), config('captchas.options.extended_yandex.subscription_view'))
            }
        }
    </script>
</div>
