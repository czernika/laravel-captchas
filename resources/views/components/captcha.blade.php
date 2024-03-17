<x-dynamic-component
    :component="'captcha::vars.'.$provider->value"
    {{ $attributes }}
/>
