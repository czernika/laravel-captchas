const unsubscribe = window.smartCaptcha.subscribe(
    smartCaptchaWidgetId,
    'challenge-visible',
    () => console.log('challenge is visible')
);
