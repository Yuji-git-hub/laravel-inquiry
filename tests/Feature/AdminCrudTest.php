<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

test('管理者一覧画面が表示できる', function() {
    get(route('admin.users.index'))
        ->assertOk();
});

test('管理者作成画面が表示できる', function () {
    get(route('admin.users.create'))
        ->assertOk();
});

test('管理者を新規作成できる', function () {
    post(route('admin.users.store'), [
        'name' => 'テスト管理者',
        'email' => 'admin_test@example.com',
        'password' => 'password',
    ])->assertRedirect(route('admin.users.index'));

    assertDatabaseHas('users', [
        'email' => 'admin_test@example.com',
    ]);
});

test('管理者編集画面が表示できる', function () {
    get(route('admin.users.edit', $this->user))
        ->assertOK();
});

test('管理者情報を更新できる', function () {
    put(route('admin.users.update', $this->user), [
        'name' => '更新後管理者',
        'email' => 'updated_test@example.com',
        'password' => 'password',
    ]);

    assertDatabaseHas('users', [
        'id' => $this->user->id,
        'name' => '更新後管理者',
    ]);
});

test('管理者を削除できる', function () {
    $targetUser = User::factory()->create();

    delete(route('admin.users.destroy', $targetUser))
        ->assertRedirect(route('admin.users.index'));

    assertDatabaseMissing('users', [
        'id' => $targetUser->id,
    ]);
});



