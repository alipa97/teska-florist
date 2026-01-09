<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile; 
use Illuminate\Support\Facades\Storage; 
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        
        $this->admin = User::create([
            'name' => 'Admin Teska',
            'email' => 'admin@teska.com',
            'password' => bcrypt('password123'),
            'role' => 'admin' 
        ]);

        Category::create(['id' => 1, 'name' => 'Bunga Segar']);
    }

    #[Test]
    public function skenario_1_create()
    {
        // Beritahu Laravel untuk pura-pura pakai folder storage
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->post(route('dashboard.products.store'), [
            'name' => 'Mawar Merah',
            'price' => 50000,
            'category_id' => 1,
            'stock_quantity' => 10,
            'slug' => 'mawar-merah',
            'image' => UploadedFile::fake()->image('mawar.jpg') // <--- SOLUSINYA DI SINI
        ]);

        $this->assertDatabaseHas('products', ['name' => 'Mawar Merah']);
        $response->assertStatus(302);
    }

    #[Test]
    public function skenario_2_read()
    {
        $response = $this->actingAs($this->admin)->get(route('dashboard.products.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function skenario_3_update()
    {
        // 1. Buat produk dulu dengan data lengkap (termasuk image)
        $product = Product::create([
            'name' => 'Melati',
            'price' => 30000,
            'category_id' => 1,
            'stock_quantity' => 5,
            'slug' => 'melati',
            'image' => 'melati.jpg' // Isi dengan string saja agar database puas
        ]);

        // 2. Jalankan aksi update
        $response = $this->actingAs($this->admin)->put(route('dashboard.products.update', $product->slug), [
            'name' => 'Melati Putih',
            'price' => 35000,
            'category_id' => 1,
            'stock_quantity' => 20
            // Jika controller update tidak mewajibkan ganti gambar, ini cukup.
            // Jika error lagi, tambahkan 'image' => UploadedFile::fake()->image('new_melati.jpg')
        ]);

        $this->assertDatabaseHas('products', ['name' => 'Melati Putih']);
    }

    #[Test]
    public function skenario_4_delete()
    {
        // Pastikan saat membuat data untuk dihapus, kolom image juga diisi
        $product = Product::create([
            'name' => 'Bunga Layu',
            'price' => 1000,
            'category_id' => 1,
            'stock_quantity' => 1,
            'slug' => 'bunga-layu',
            'image' => 'layu.jpg' 
        ]);

        $response = $this->actingAs($this->admin)->delete(route('dashboard.products.destroy', $product->id));
        $this->assertDatabaseMissing('products', ['name' => 'Bunga Layu']);
    }
}