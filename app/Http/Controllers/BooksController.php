<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::query()->OrderBy('title')->get();

        return response()->json($books);
    }
}
