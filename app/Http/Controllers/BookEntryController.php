<?php

namespace App\Http\Controllers;

use App\Models\BookEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookEntryController extends Controller
{
    
    public function list()
    {
        $list = BookEntry::latest()->paginate(10);
        return response()->json($list,200);
    }

    public function user_entries()
    {
        $list = BookEntry::latest()->where('user_id',Auth::user()->id)->paginate(10);
        return response()->json($list,200);
    }

    public function getentry(BookEntry $entry)
    {
        return $entry;
    }

    public function return_book(Request $request)
    {
        BookEntry::where('id',$request->id)->update([
            'book_return' => 1,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        return response()->json('success',200);
    }

    public function create(Request $request)
    {
        if (count($request->book_ids) > 0) {
            foreach ($request->book_ids as $book_id) {
                BookEntry::insert([
                    'user_id' => $request->user_id,
                    'book_id' => $book_id,
                    'time' => $request->time,
                    'date' => $request->date,
                    'return_date' => $request->return_date,
                    'created_at' => Carbon::now()->toDateTimeString(),
                ]);
            }
            return response()->json('success');
        } else {
            return response()->json('there is no books', 400);
        }
    }
}
