<?php

use App\Category;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $user = User::create([
            'name' => "admin",
            'email' => "admin@domain.net",
            'password' => Hash::make("mypassword123"),
            'phone' => '7783283347',
            'country_code' => '123',
            'birthday' => '1992-02-02 00:00:00',
            'user_image' => '',
            'is_admin' => '1',
        ]);

        $user->assignRole('admin');


        // $id=User::create([
        //     'name' => "Majd",
        //     'email' => "Majd@domain.net",
        //     'password' => Hash::make("mypassword123"),
        //     'phone' => '7783283347',
        //     'country_code' => '123',
        //     'birthday' => '1992-02-02 00:00:00',
        //     'user_image' => '',
        //     'is_admin' => '1',
        // ]);

        Category::create([
            'name' => 'Salary',
            'type' => 'income'
        ]);

        Category::create([
            'name' => 'Bonuses',
            'type' => 'income'
        ]);

        Category::create([
            'name' => 'Overtime',
            'type' => 'income'
        ]);
        Category::create([
            'name' => 'Housing',
            'type' => 'expanse'
        ]);
        Category::create([
            'name' => 'Food & Drinks',
            'type' => 'expanse'
        ]);
        Category::create([
            'name' => 'Shopping',
            'type' => 'expanse'
        ]);
        Category::create([
            'name' => 'Transportation',
            'type' => 'expanse'
        ]);
    }
}
