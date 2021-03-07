<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'user']);

        User::create([
            'name' => "admin",
            'email' => "admin@domain.net",
            'password' => Hash::make("mypassword123"),
            'phone' => '7783283347',
            'country_code' => '123',
            'birthday' => '1992-02-02 00:00:00',
            'user_image' => '',
            'is_admin' => '1',
        ]);


    }
}
