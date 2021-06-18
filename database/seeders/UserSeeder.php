<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory(1)->create();
        $user = $user[0]->toArray();
        $user = \App\Models\User::find($user["id"])->first();
        $user->assignRole("Admin");
        $this->command->info('Here is your admin details to login:');
        $this->command->warn($user->email);
        $this->command->warn('Password is "secret"');
    }
}
