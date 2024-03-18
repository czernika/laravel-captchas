<x-dynamic-component
    :component="'captcha::vars.'.$provider->value"
    :options="json_encode($options)"
    {{ $attributes }}
/>
