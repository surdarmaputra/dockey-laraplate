<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = factory(App\User::class)->create([
            'username' => 'admin',
            'full_name' => 'Administrator',
            'email' => 'admin@dockeylaraplate.io',
            'password' => 'secret',
            'built_in' => 1,
            'active' => 1,
        ]);
    }
}
