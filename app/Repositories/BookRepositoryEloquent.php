<?php

namespace App\Repositories;

use App\Book;
use Illuminate\Support\Facades\DB;

class BookRepositoryEloquent implements BookRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new Book();
    }

    public function findAll()
    {
        return $this->model->query()->OrderBy('title')->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($title, $cover, $genre, $description, $salePrice)
    {
        DB::beginTransaction();
        Book::create([
            'title' => $title,
            'cover' => $cover,
            'genre' => $genre,
            'description' => $description,
            'sale_price' => $salePrice
        ]);
        DB::commit();

        return true;
    }

    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            $book = Book::find($id);
            $book->delete();
        });

        return true;
    }

    public function update($id, $title, $cover, $genre, $description, $salePrice)
    {
        $book = Book::find($id);
        $title ? $book->title = $title : '';
        $cover ? $book->cover = $cover : '';
        $genre ? $book->genre = $genre : '';
        $description ? $book->description = $description : '';
        $salePrice ? $book->sale_price = $salePrice : '';
        $book->save();

        return true;
    }
}
