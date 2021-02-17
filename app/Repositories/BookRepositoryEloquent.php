<?php

namespace App\Repositories;

use App\Book;

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
}
