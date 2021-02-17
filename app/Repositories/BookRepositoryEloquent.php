<?php

namespace App\Repositories;

use App\Book;
use Illuminate\Support\Facades\DB;

class BookRepositoryEloquent implements BookRepositoryInterface
{
    private $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->query()->OrderBy('title')->get();
    }

    public function findById($id)
    {
        return $this->model->query()->find($id);
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
}
