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
            'name' => 'admin',
            'email' => 'admin@dockeylaraplate.io',
            'password' => 'secret'
        ]);
    }
}
