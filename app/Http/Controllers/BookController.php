<?php

namespace App\Http\Controllers;

use App\Book;
use App\Repositories\BookRepositoryEloquent;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(BookRepositoryEloquent $repository)
    {
        $books = $repository->findAll();

        return response()->json($books);
    }

    public function show(int $id, BookRepositoryEloquent $repository)
    {
        $book = $repository->findById($id);

        if (is_null($book)) {
            return response()->json('', 204);
        }

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
        $book = $repository->create(
            $request->title,
            $cover,
            $request->genre,
            $request->description,
            $request->sale_price
        );

        return response()->json($book);
    }

    public function destroy(int $id, BookRepositoryEloquent $repository)
    {
        $response = $repository->delete($id);

        return response()->json($response['message'], $response['statusCode']);
    }

    public function update(int $id, Request $request, BookRepositoryEloquent $repository)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'cover' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'sale_price' => 'required'
        ]);

        $book = $repository->update(
            $id,
            $request->title,
            $request->cover,
            $request->genre,
            $request->description,
            $request->sale_price
        );

        if (is_null($book)) {
            return response()->json('Not Found', 404);
        }

        return $book;
    }
}
