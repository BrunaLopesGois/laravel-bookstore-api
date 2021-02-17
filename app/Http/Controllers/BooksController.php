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
}
