<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Classes\enums\RoleEnum;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new User();
        $administrator->name = "Николай";
        $administrator->surname = "Петров";
        $administrator->email = "admin@example.com";
        $administrator->password = bcrypt("secret");
        $administrator->save();
        $administrator->roles()->attach(Role::where("name", RoleEnum::ROLE_ADMINISTRATOR)->first());

        $techManager = new User();
        $techManager->name = "Иван";
        $techManager->surname = "Иванов";
        $techManager->email = "manager@example.com";
        $techManager->password = bcrypt("secret");
        $techManager->save();
        $techManager->roles()->attach(Role::where("name", RoleEnum::ROLE_TECHNICAL_MANAGER)->first());

        $optimizer = new User();
        $optimizer->name = "Василий";
        $optimizer->surname = "Пупкин";
        $optimizer->email = "optimizer@example.com";
        $optimizer->password = bcrypt("secret");
        $optimizer->save();
        $optimizer->roles()->attach(Role::where("name", RoleEnum::ROLE_OPTIMIZER)->first());

        $client = new User();
        $client->name = "Михаил";
        $client->surname = "Баранов";
        $client->email = "client@example.com";
        $client->password = bcrypt("secret");
        $client->save();
        $client->roles()->attach(Role::where("name", RoleEnum::ROLE_CLIENT)->first());

        $client = new User();
        $client->name = "Михаил";
        $client->surname = "Штольц";
        $client->email = "client1@example.com";
        $client->password = bcrypt("secret");
        $client->save();
        $client->roles()->attach(Role::where("name", RoleEnum::ROLE_CLIENT)->first());
    }
}
