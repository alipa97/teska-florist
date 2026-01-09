<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class AuthRegisTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Mematikan pengecekan Vite secara global di file ini agar tidak error manifest
        $this->withoutVite();
    }

    #[Test]
    public function user_bisa_daftar_akun_baru()
    {
        // Akses route post('/daftar') sesuai name('register_post')
        $response = $this->post(route('register_post'), [
            'name' => 'User Baru',
            'email' => 'baru' . rand(1,99) . '@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Pastikan data masuk ke database
        $this->assertDatabaseHas('users', [
            'name' => 'User Baru'
        ]);
    }
}
