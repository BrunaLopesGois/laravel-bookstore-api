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

    public function destroy(int $id, BookRepositoryEloquent $repository)
    {
        $deleted = $repository->delete($id);

        return $deleted;
    }

    public function update(int $id, Request $request, BookRepositoryEloquent $repository)
    {
        $updated = $repository->update(
            $id,
            $request->title,
            $request->cover,
            $request->genre,
            $request->description,
            $request->sale_price
        );

        return $updated;
    }
}
