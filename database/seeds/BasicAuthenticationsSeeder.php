<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BasicAuthenticationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $builtInPermissions = [
            ['name' => 'create-role'],
            ['name' => 'read-role'],
            ['name' => 'update-role'],
            ['name' => 'delete-role'],
            ['name' => 'read-permission'],
            ['name' => 'update-permission'],
            ['name' => 'create-post'],
            ['name' => 'read-post'],
            ['name' => 'update-post'],
            ['name' => 'delete-post'],
        ];
        $builtInRolesAndUsers = [
            'super-admin' => [
                'name' => 'super-admin',
                'built_in' => 1,
                'permissions' => [
                    'create-role',
                    'read-role',
                    'update-role',
                    'delete-role',
                    'read-permission',
                    'update-permission',
                ],
                'users' => [
                    [
                        'username' => 'admin',
                        'full_name' => 'Administrator',
                        'email' => 'admin@dockeylaraplate.io',
                        'password' => 'secret',
                        'active' => 1,
                        'built_in' => 1,
                    ],
                ],
            ],
            'owner' => [
                'name' => 'owner',
                'built_in' => 0,
                'permissions' => [
                    'read-role',
                    'read-permission',
                ],
                'users' => [
                    [
                        'username' => 'ownser',
                        'full_name' => 'Owner',
                        'email' => 'owner@dockeylaraplate.io',
                        'password' => 'secret',
                        'active' => 1,
                        'built_in' => 0,
                    ],
                ],
            ],
            'contributor' => [
                'name' => 'contributor',
                'built_in' => 0,
                'permissions' => [
                    'create-post',
                    'read-post',
                    'update-post',
                    'delete-post',
                ],
                'users' => [
                    [
                        'username' => 'contributor1',
                        'full_name' => 'Contributor 1',
                        'email' => 'contributor1@dockeylaraplate.io',
                        'password' => 'secret',
                        'active' => 1,
                        'built_in' => 0,
                    ],
                ],
            ],
        ];

        foreach ($builtInPermissions as $permission) {
            \App\Permission::firstOrCreate([
                'name' => $permission['name'],
                'display_name' => ucwords(str_replace('-', ' ', $permission['name'])),
                'description' => ucwords(str_replace('-', ' ', $permission['name'])),
                'built_in' => 1,
            ]);
            $this->command->info('Creating Permission: '. ucwords(str_replace('-', ' ', $permission['name'])));
        }
        foreach ($builtInRolesAndUsers as $key => $role) {
            $persistedRole = \App\Role::create([
                'name' => $role['name'],
                'display_name' => ucwords(str_replace('-', ' ', $role['name'])),
                'description' => ucwords(str_replace('-', ' ', $role['name'])),
                'built_in' => $role['built_in'],
            ]);
            $this->command->info('Creating Role: '. ucwords(str_replace('-', ' ', $key)));

            $permissions = [];
            foreach ($role['permissions'] as $permissionName) {
                $permissions[] = \App\Permission::where('name', $permissionName)->first();   
            }
            $persistedRole->attachPermissions($permissions);

            foreach ($role['users'] as $user) {
                $persistedUser = factory(App\User::class)->create($user);
                $this->command->info('Creating User: '. $user['full_name'].' ('.$user['username'].')');
                $persistedUser->attachRole($persistedRole);
                $this->command->info('Attach Role '. $persistedRole['display_name'] .' to User '. $user['full_name']);
            }
        }
    }
}
