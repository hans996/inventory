<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Inventory;
use App\Models\Position;
use App\Models\Suplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  
        Position::factory()->create([
            'name' => 'Admin',
            'role_as' => 1,
        ]);
        Position::factory()->create([
            'name' => 'User',
            'role_as' => 0,
        ]);
        
        User::factory()->create([
            'name' => 'Admin',
            'avatar' => 'default.png',
            'email' => 'admin@gmail.com',
            'position_id' => 1,
            'status' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'name' => 'User',
            'avatar' => 'default.png',
            'email' => 'user@gmail.com',
            'position_id' => 2,
            'status' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('password12345'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'name' => 'Non Active User',
            'avatar' => 'default.png',
            'email' => 'nonactive@gmail.com',
            'position_id' => 2,
            'status' => 0,
            'email_verified_at' => now(),
            'password' => bcrypt('password12345'),
            'remember_token' => Str::random(10),
        ]);

        Suplier::factory()->create([
            'name' => 'Unknown',
            'alamat' => 'Unknown',
            'telepon' => '0987654321',
            'email' => 'example@example.com',
        ]);

        Position::factory(10)->create();
        User::factory(50)->create();
        Suplier::factory(50)->create();

        $this->call(InventorySeeder::class);
        $this->call(SubmissionSeeder::class);

        // Inventory::factory(20)->create([
        //     'kode_barang' => 'BX'. $this()->faker->unique->numberBetween(100041,100060),
        //     'suplier_id' => mt_rand(1,6),
        //     'user_id' => 3,
        //     'lokasi' => $this()->faker->word(),
        //     'jumlah' => mt_rand(70,300),
        // ]);

        // Inventory::factory(50)->create();
        // Submission::factory(50)->create();
        
        // Inventory::factory(300)->create();
        // Submission::factory(300)->create();
    }
}
