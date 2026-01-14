<?php

namespace tests\Feature\PHPUnit\Inquiry;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InquiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_お問い合わせフォームが表示できる()
    {
        $response = $this->get(route('inquiries.index'));

        $response->assertStatus(200);
        $response->assertSee('お問い合わせ画面');
    }

    public function test_お問い合わせを登録できる()
    {
        $data = [
            'name' => 'テスト',
            'email' => 'test@example.com',
            'type' => 'estimate',
            'content' => 'テストテキスト',
        ];

        $response = $this->post(route('inquiries.store', $data));

        $response->assertRedirect(route('inquiries.complete'));

        $this->assertDatabaseHas('inquiries', [
            'name' => 'テスト',
            'email' => 'test@example.com',
            'type' => 'estimate',
            'content' => 'テストテキスト',
        ]);
    }

    public function test_お問い合わせ完了画面が表示される()
    {
        $response = $this->get(route('inquiries.complete'));

        $response->assertStatus(200);
        $response->assertSee('お問い合わせ完了画面');
    }
}