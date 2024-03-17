<?php

uses()->group('feature.yandex.render');

beforeEach(function () {
    config()->set('captchas.keys.client', 'CLIENT');
    config()->set('captchas.keys.secret', 'SECRET');
});

describe('component', function () {
    it('renders view component', function () {
        $view = $this->blade('<x-captcha />');

        $view
            ->assertSee('data-sitekey="CLIENT"', false)
            ->assertSee('class="smart-captcha"', false);
    });
});
