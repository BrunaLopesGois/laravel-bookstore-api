<?php

namespace App\Repositories;

interface BookRepositoryInterface
{
    public function findAll();
    public function findById($id);
    public function create($title, $cover, $genre, $description, $salePrice);
    public function delete($id);
}
