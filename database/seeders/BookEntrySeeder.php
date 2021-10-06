<?php

namespace Database\Seeders;

use App\Models\BookEntry;
use Illuminate\Database\Seeder;

class BookEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookEntry::insert([
            'user_id' => 4,
            'book_id' => rand(1,100),
            'date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'return_date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'time' => rand(1,12).':'.rand(1,60),
        ]);
        BookEntry::insert([
            'user_id' => 4,
            'book_id' => rand(1,100),
            'date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'return_date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'time' => rand(1,12).':'.rand(1,60),
        ]);
        BookEntry::insert([
            'user_id' => 4,
            'book_id' => rand(1,100),
            'date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'return_date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'time' => rand(1,12).':'.rand(1,60),
        ]);
        BookEntry::insert([
            'user_id' => 4,
            'book_id' => rand(1,100),
            'date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'return_date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'time' => rand(1,12).':'.rand(1,60),
        ]);
        BookEntry::insert([
            'user_id' => 4,
            'book_id' => rand(1,100),
            'date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'return_date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'time' => rand(1,12).':'.rand(1,60),
        ]);
        BookEntry::insert([
            'user_id' => 4,
            'book_id' => rand(1,100),
            'date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'return_date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'time' => rand(1,12).':'.rand(1,60),
        ]);
        BookEntry::insert([
            'user_id' => 4,
            'book_id' => rand(1,100),
            'date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'return_date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'time' => rand(1,12).':'.rand(1,60),
        ]);
        BookEntry::insert([
            'user_id' => 4,
            'book_id' => rand(1,100),
            'date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'return_date' => '2021-'.rand(1,12).'-'.rand(1,30),
            'time' => rand(1,12).':'.rand(1,60),
        ]);
    }
}
