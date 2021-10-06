<?php

namespace Database\Seeders;

use App\Models\BookEntry;
use App\Models\BookList;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        UserRole::truncate();
        BookList::truncate();
        BookEntry::truncate();

        $this->call([
            UserRoleSeeder::class,
            BookListSeeder::class,
            BookEntrySeeder::class,
        ]);

        User::insert([
            'name' => 'super_admin',
            'email' => 'super_admin@gmail.com',
            'role_serial' => 1,
            'password' => Hash::make('12345678'),
        ]);
        User::insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role_serial' => 2,
            'password' => Hash::make('12345678'),
        ]);
        User::insert([
            'name' => 'management',
            'email' => 'management@gmail.com',
            'role_serial' => 3,
            'password' => Hash::make('12345678'),
        ]);
        User::insert([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'role_serial' => 4,
            'password' => Hash::make('12345678'),
        ]);
    }
}
