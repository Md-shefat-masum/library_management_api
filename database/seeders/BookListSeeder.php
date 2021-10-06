<?php

namespace Database\Seeders;

use App\Models\BookList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class BookListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://openlibrary.org/search.json?q=web');
        $sections = [ 'A','B','C','D','E'];

        $books = $response->json()['docs'];
        foreach ($books as $book) {
            $book = (object) $book;
            BookList::insert([
                'name' => substr($book->title,0,99),
                'image' => 'covers.openlibrary.org/b/id/'.(isset($book->cover_i)?$book->cover_i:'8311467').'-M.jpg',
                'section' => $sections[rand(0,4)],
                'published_date' => (isset($book->first_publish_year)?$book->first_publish_year:'1995'),
            ]);
        }
    }
}
