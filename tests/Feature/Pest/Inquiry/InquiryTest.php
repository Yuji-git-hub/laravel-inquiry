<?php

namespace tests\Feature\Pest\Inquiry;

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('お問い合わせ画面が表示される', function () {
    get(route('inquiries.index'))
        ->assertOk();
});

test('お問い合わせ内容が保存される', function () {
    $data = [
        'name' => '山田太郎',
        'email' => 'test@example.com',
        'type' => 'recruit',
        'content' => 'お問い合わせ内容',
    ];

    post(route('inquiries.store'), $data)
        ->assertRedirect(route('inquiries.complete'));

    assertDatabaseHas('inquiries', [
        'name' => '山田太郎',
        'email' => 'test@example.com',
        'type' => 'recruit',
        'content' => 'お問い合わせ内容',
    ]);
});

test('お問い合わせ完了画面が表示される', function () {
    get(route('inquiries.complete'))
        ->assertOk();
});