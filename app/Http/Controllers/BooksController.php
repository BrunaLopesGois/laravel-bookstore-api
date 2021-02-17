<?php

namespace App\Http\Controllers;

use App\Book;
use App\Repositories\BookRepositoryEloquent;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(BookRepositoryEloquent $repository)
    {
        $books = $repository->findAll();

        return response()->json($books);
    }

    public function bookDetail(Request $request, BookRepositoryEloquent $repository)
    {
        $book = $repository->findById($request->id);

        return response()->json($book);
    }

    public function store(Request $request, BookRepositoryEloquent $repository)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'genre' => 'required',
            'description' => 'required',
            'sale_price' => 'required'
        ]);
        $cover = null;
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover')->store('book');
        }
        $created = $repository->create(
            $request->title,
            $cover,
            $request->genre,
            $request->description,
            $request->sale_price
        );

        return $created;
    }
}
