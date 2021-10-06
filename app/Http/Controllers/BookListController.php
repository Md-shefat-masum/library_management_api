<?php

namespace App\Http\Controllers;

use App\Models\BookList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\fileExists;

class BookListController extends Controller
{
    public function book_list()
    {
        $book_list = BookList::where('status', 1)->orderBy('id','DESC')->paginate(10);
        return response()->json($book_list, 200);
    }

    public function get($id)
    {
        $book = BookList::find($id);
        return response()->json($book, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:4'],
            'author' => ['required'],
            'section' => ['required'],
            'image' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $book = BookList::create($request->except('image'));
        if($request->hasFile('image')){
            $book->image = Storage::put('upload/books', $request->file('image'));
            $book->save();
        }

        return response()->json($book,200);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:4'],
            'author' => ['required'],
            'section' => ['required'],
            // 'image' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $book = BookList::find($request->id);
        // $book = BookList::create($request->except('image'));
        $book->fill($request->except('image'))->save();
        if($request->hasFile('image')){
            $book->image = Storage::put('upload/books', $request->file('image'));
            $book->save();
        }

        return response()->json($book,200);
    }

    public function delete(Request $request)
    {
        $book= BookList::find($request->id);
        if(file_exists(public_path($book->image))){
            unlink(public_path($book->image));
        }
        $book->delete();
        return response()->json('deleted',200);
    }
}
