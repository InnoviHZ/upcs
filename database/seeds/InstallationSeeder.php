<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class InstallationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['role_name' => 'Administrator']);
        Role::create(['role_name' => 'Super Administrator']);

        User::create([
            'username' => 'dseries',
            'password' => Hash::make('login'),
            'firstname' => 'Samuel',
            'lastname' => 'Ajoka',
            'email' => 'samajoka@gmail.com',
            'role_id' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
