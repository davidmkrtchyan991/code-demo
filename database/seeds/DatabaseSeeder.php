<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        // User seeder will use the roles above created.
        $this->call(UserTableSeeder::class);

        $this->call(TariffTableSeeder::class);
        $this->call(MaintenanceTableSeeder::class);
        $this->call(ChecklistTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(FaqTableSeeder::class);
    }
}
