<?php

namespace tests\Feature\PHPUnit\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_管理者一覧画面が表示できる()
    {
        $adminUser = User::factory()->create();

        $this->actingAs($adminUser);

        $response = $this->get(route('admin.users.index'));

        $response->assertStatus(200);
        $response->assertSee('管理ユーザー一覧');
    }

    public function test_管理者登録画面が表示できる()
    {
        $adminUser = User::factory()->create();

        $this->actingAs($adminUser);

        $response = $this->get(route('admin.users.create'));

        $response->assertStatus(200);
    }

    public function test_管理者を登録できる()
    {
        $adminUser = User::factory()->create();

        $this->actingAs($adminUser);

        $data = [
            'name' => 'テスト管理者',
            'email' =>'test@example.com',
            'password' => 'password',
        ];

        $response = $this->post(route('admin.users.store'), $data);

        $response->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'name' => 'テスト管理者',
            'email' => 'test@example.com',
        ]);
    }

    public function test_管理者編集画面が表示される()
    {
        $adminUser = User::factory()->create();

        $targetUser = User::factory()->create();

        $this->actingAs($adminUser);

        $response = $this->get(route('admin.users.edit', $targetUser));

        $response->assertStatus(200);
        $response->assertSee('管理ユーザー編集画面');
    }

    public function test_管理者が更新できる()
    {
        $adminUser = User::factory()->create();

        $targetUser = User::factory()->create();

        $this->actingAs($adminUser);

        $data = [
            'name' => '更新後管理者',
            'email' => 'updated_test@example.com',
            'password' => 'password',
        ];

        $response = $this->put(
            route('admin.users.update', $targetUser->id),
            $data
        );

        $response->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'name' => '更新後管理者',
            'email' => 'updated_test@example.com',
        ]);
    }

    public function test_管理者が削除される()
    {
        $adminUser = User::factory()->create();

        $targetUser = User::factory()->create();

        $this->actingAs($adminUser);

        $response = $this->delete(route('admin.users.destroy', $targetUser->id));

        $response->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseMissing('users', ['id' => $targetUser->id]);
    }
}