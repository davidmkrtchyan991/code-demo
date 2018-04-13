<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Classes\enums\RoleEnum;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(RoleEnum::getKeys())->each(function ($roleName, $key) {
            $role =  new Role();
            $role->name = $roleName;
            $role->description = $roleName;
            $role->save();
        });
    }
}
