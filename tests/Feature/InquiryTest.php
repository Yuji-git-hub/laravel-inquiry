<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('お問い合わせ画面が表示される', function () {
    get('/inquiries')
        ->assertOk();
});

test('お問い合わせ内容が保存される', function () {
    post('/inquiries', [
        'name' => '山田太郎',
        'email' => 'test@example.com',
        'type' => 'recruit',
        'content' => 'お問い合わせ内容',
    ])
        ->assertRedirect();

    $this->assertDatabaseHas('inquiries', [
        'email' => 'test@example.com',
        'type' => 'recruit',
    ]);
});