<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'kode_barang' => null,
            'suplier_id' => null,
            'user_id' => 1,
            'lokasi' => null,
            'jumlah' => 0,
            'keterangan' => $this->faker->paragraph(2),
            'jenis' => mt_rand(1, 2),
        ];
    }
}
