<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        
        // Setup User biasa (Customer)
        $this->user = User::create([
            'name' => 'User Lama',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password_lama'),
            'role' => 'customer'
        ]);
    }

    #[Test]
    public function skenario_1_update_biodata_profil()
    {
        // Mengacu pada route name('profile.update') di web.php
        $response = $this->actingAs($this->user)->put(route('profile.update'), [
            'name' => 'User Baru',
            'email' => 'user_baru@gmail.com'
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'User Baru',
            'email' => 'user_baru@gmail.com'
        ]);
        $response->assertStatus(302);
    }

    #[Test]
    public function skenario_2_ubah_password_keamanan()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)->put(route('profile.change_password'), [
            'old-password'              => 'password_lama',
            'new-password'              => 'password_baru123',
            'new-password_confirmation' => 'password_baru123'
        ]);

        $this->user->refresh();

        // Verifikasi
        $response->assertStatus(302);
        // Pastikan Hash::check berhasil dengan password baru
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('password_baru123', $this->user->password));
    }
}