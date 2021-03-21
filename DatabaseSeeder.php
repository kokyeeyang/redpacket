<?php

// namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\Models\User::factory()->count(20)->create();
        App\Models\RedPacket::factory()->count(20)->create();
        App\Models\Transaction::factory()->count(20)->create();
    }
}
