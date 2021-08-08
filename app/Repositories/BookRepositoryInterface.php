<?php

namespace App\Repositories;

interface BookRepositoryInterface
{
    public function findAll($search);
    public function findById($id);
    public function create($title, $cover, $genre, $description, $salePrice);
    public function delete($id);
    public function update($id, $title, $cover, $genre, $description, $salePrice);
}
