<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\Setting;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            CategorySeeder::class,
            CategoryGroupSeeder::class,
            DeliveryAreaSeeder::class,
        ]);

        Product::factory()
            ->withRandomThumbnail()
            ->withRandomGallerys()
            ->withSizes()
            ->withDetails()
            ->count(20)
            ->create();
    }
}
