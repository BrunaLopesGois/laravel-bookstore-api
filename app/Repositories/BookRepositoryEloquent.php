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

    public function findAll($search)
    {
        if ($search) {
            return $this->model
                ->query()
                ->where('title', 'LIKE', "%{$search}%")
                ->get();
        }

        return $this->model->query()->OrderBy('title')->paginate(12);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($title, $cover, $genre, $description, $salePrice)
    {
        DB::beginTransaction();
        $book = Book::create([
            'title' => $title,
            'cover' => $cover,
            'genre' => $genre,
            'description' => $description,
            'sale_price' => $salePrice
        ]);
        DB::commit();

        return $book;
    }

    public function delete($id)
    {
        $booksRemoved = Book::destroy($id);

        if ($booksRemoved === 0) {
            return [
                'message' => 'Not Found',
                'statusCode' => 404
            ];
        }

        return [
            'message' => '',
            'statusCode' => 204
        ];
    }

    public function update($id, $title, $cover, $genre, $description, $salePrice)
    {
        $book = Book::find($id);

        if (is_null($book)) {
            return null;
        }

        if ($cover) {
            $book->cover = $cover;
        }

        $book->title = $title;
        $book->genre = $genre;
        $book->description = $description;
        $book->sale_price = $salePrice;
        $book->save();

        return $book;
    }
}
