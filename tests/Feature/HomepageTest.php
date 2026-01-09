<?php

test('homepage can be rendered', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Hello there!');
});
