<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    $userIds = User::pluck('id')->toArray();

    Inventory::factory()->count(500)->make()->each(function ($inventory) use ($userIds) {
        // $inventory->kode_barang = 'BX' . fake()->unique()->numberBetween(100001, 105000);
        // $inventory->suplier_id = mt_rand(1, 6);
        $inventory->user_id = fake()->randomElement($userIds);
        // $inventory->lokasi = fake()->word();
        $inventory->created_at = fake()->dateTime()->format('d-m-Y H:i:s');
        $inventory->updated_at = fake()->dateTime()->format('d-m-Y H:i:s');
        $inventory->save();
    });
    Inventory::factory()->count(1000)->make()->each(function ($inventory) use ($userIds) {
        $inventory->kode_barang = 'BX' . fake()->unique()->numberBetween(100001, 101000);
        $inventory->suplier_id = mt_rand(1, 6);
        $inventory->user_id = fake()->randomElement($userIds);
        $inventory->lokasi = fake()->word();
        $inventory->jumlah = mt_rand(70, 300);
        $inventory->created_at = fake()->dateTime()->format('d-m-Y H:i:s');
        $inventory->updated_at = fake()->dateTime()->format('d-m-Y H:i:s');
        $inventory->save();
    });
    }
}
