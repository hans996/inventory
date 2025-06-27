<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventoryIds = Inventory::pluck('id')->toArray();

        Submission::factory()->count(500)->make()->each(function ($submission)  {
            $submission->inventory_id = fake()->unique()->numberBetween(1, 500);
            $submission->user_id = mt_rand(1,10);
            $submission->status = mt_rand(1,2);
            $submission->kode_permintaan = 'TX' . fake()->unique()->numberBetween(200001, 200500);
            $submission->jumlah = mt_rand(70, 300);
            $submission->created_at = fake()->dateTime()->format('d-m-Y H:i:s');
            $submission->updated_at = fake()->dateTime()->format('d-m-Y H:i:s');
            $submission->save();
        });

        Submission::factory()->count(1000)->make()->each(function ($submission)  {
            $submission->inventory_id = fake()->unique()->numberBetween(501, 1500);
            $submission->user_id = mt_rand(1,10);
            $submission->status = 3;
            $submission->kode_permintaan = 'TX' . fake()->unique()->numberBetween(205001, 201500);
            $submission->jumlah = mt_rand(70, 300);
            $submission->created_at = fake()->dateTime()->format('d-m-Y H:i:s');
            $submission->updated_at = fake()->dateTime()->format('d-m-Y H:i:s');
            $submission->save();
        });

    }
}
