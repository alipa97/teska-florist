<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up lingkungan testing sebelum menjalankan setiap fungsi test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        // Mematikan pengecekan Vite secara global di file ini agar tidak error manifest
        $this->withoutVite();
    }

    #[Test]
    public function user_bisa_mengakses_halaman_masuk()
    {
        // Sesuaikan dengan route get('/masuk')
        $response = $this->get('/masuk');

        $response->assertStatus(200);
    }

    #[Test]
    public function user_bisa_login_dengan_data_yang_benar()
    {
        // 1. Buat user dummy (Gunakan create() biasa jika factory bermasalah dengan kolom)
        $user = User::create([
            'name' => 'Tester',
            'email' => 'test' . rand(1,99) . '@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        // 2. Akses route post('/masuk') sesuai name('login_post')
        $response = $this->post(route('login_post'), [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // 3. Verifikasi
        $this->assertAuthenticatedAs($user);
        
        // Status 302 berarti berhasil login dan diredirect
        $response->assertStatus(302); 
    }
}