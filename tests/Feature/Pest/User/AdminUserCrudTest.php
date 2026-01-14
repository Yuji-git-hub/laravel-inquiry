<?php

namespace tests\Feature\Pest\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('管理ユーザー一覧画面が表示される', function () {
    $adminUser = User::factory()->create();

    actingAs($adminUser)
        ->get(route('admin.users.index'))
        ->assertOk();
});

test('管理ユーザー作成画面が表示される', function () {
    $adminUser = User::factory()->create();

    actingAs($adminUser)
        ->get(route('admin.users.create'))
        ->assertOk();
});

test('管理ユーザーが保存される', function () {
    $adminUser = User::factory()->create();

    actingAs($adminUser)
        ->post(route('admin.users.store'), [
            'name' => '山田太郎',
            'email' => 'test@example.com',
            'password' => 'password',
        ])
        ->assertRedirect(route('admin.users.index'));

    assertDatabaseHas('users', [
        'name' => '山田太郎',
        'email' => 'test@example.com',
    ]);
});

test('管理ユーザー編集画面が表示される', function () {
    $adminUser = User::factory()->create();

    $targetUser = User::factory()->create();

    actingAs($adminUser)
        ->get(route('admin.users.edit', $targetUser->id))
        ->assertOk();
});

test('管理ユーザーが更新される', function () {
    $adminUser = User::factory()->create();

    $targetUser = User::factory()->create([
        'name' => 'Before Name',
        'email' => 'before@example.com',
        'password' => 'password',
    ]);

    actingAs($adminUser)
        ->put(route('admin.users.update', $targetUser->id), [
            'name' => 'After Name',
            'email' => 'after@example.com',
            'password' => 'password',
        ])
        ->assertRedirect();

    assertDatabaseHas('users', [
        'id' => $targetUser->id,
        'name' => 'After Name',
        'email' => 'after@example.com',
    ]);
});

test('管理ユーザーが削除される', function () {
    $adminUser = User::factory()->create();

    $targetUser = User::factory()->create([
        'name' => 'name',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    actingAs($adminUser)
        ->delete(route('admin.users.destroy', $targetUser->id))
        ->assertRedirect(route('admin.users.index'));

    assertDatabaseMissing('users', [
        'id' => $targetUser->id,
    ]);
});